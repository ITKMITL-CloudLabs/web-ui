<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        switch ($request->get('only', 'all')) {
            case 'student':
                $users = User::onlyStudent()->paginate(20);
                break;
            case 'instructor':
                $users = User::onlyInstructor()->paginate(20);
                break;
            case 'ta':
                $users = User::onlyTA()->paginate(20);
                break;
            default:
                $users = User::paginate(20);
        }

        return view('admin.user.index', [
            'users' => $users->appends($request->except('page'))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userData = $this->validate($request, [
            'username' => 'required',
            'password' => 'required|min:6',
            'name'     => 'required',
            'role'     => 'required'
        ]);

        $identity = resolve('OpenStackApi')->identityV3();
        $user = $identity->createUser([
            'defaultProjectId' => env('OS_AUTH_SCOPE_PROJECT_ID'),
            'domainId'         => env('OS_AUTH_DOMAIN'),
            'enabled'          => $request->enabled == 1,
            'description'      => $userData['name'],
            'name'             => $userData['username'],
            'password'         => $userData['password']
        ]);

        $localUser = new User();
        $localUser->id = $user->id;
        $localUser->name = $user->name;
        $localUser->description = $user->description;
        $localUser->role = $userData['role'];
        $localUser->enabled = $request->enabled == 1;
        $localUser->save();

        $project = $identity->getProject(env('OS_AUTH_SCOPE_PROJECT_ID'));
        $project->grantUserRole([
            'userId' => $user->id,
            'roleId' => env('OS_ADMIN_ROLE_ID')
        ]);

        //Add User to Group
	    $group = $identity->getGroup(env('OS_ADMIN_GROUP_ID'));
	    $group->addUser(['userId' => $user->id]);

        return redirect(route('admin.user.index'))->with('alert_success', 'สร้างผู้ใช้สำเร็จ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	    $identity = resolve('OpenStackApi')->identityV3();

    	$user = User::findOrFail($id);

    	$username = $identity->getUser($user->id);
    	$username->retrieve();

        return view('admin.user.edit', compact('user', 'username'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

	    $identity = resolve('OpenStackApi')->identityV3();
	    $userFromOs = $identity->getUser($user->id);
	    $userFromOs->description = $request->name;
	    $userFromOs->update();

        $user->role = $request->role;
        $user->description = $request->name;
        $user->save();

        return redirect(route('admin.user.index'))->with('alert_success', 'แก้ไขข้อมูลผู้ใช้สำเร็จ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = resolve('OpenStackApi')->identityV3()->getUser($id);
        $user->retrieve();
        $user->delete();

        User::destroy($id);

        return redirect(route('admin.user.index'));
    }
}
