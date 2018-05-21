<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FlavorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flavors = resolve('OpenStackApi')->computeV2()->listFlavors([], function ($flavor) {
                return $flavor;
            }, true);

        return view('admin.flavor.index', compact('flavors', 'counter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $option = [
            "name" => $request->name,
            "ram" => (int) $request->ram,
            "vcpus" => (int) $request->vcpus,
            "disk" => (int) $request->disk
        ];

        resolve('OpenStackApi')->computeV2()->createFlavor($option);

        return redirect(route('admin.flavor.index'))->with('alert_success', 'สร้างเทมเพลตสำเร็จ');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string Image ID
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string Image ID
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string Image ID
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        resolve('OpenStackApi')->computeV2()->getFlavor(['id' => $id])->delete();

        return redirect(route('admin.flavor.index'))->with('alert_success', 'เทมเพลตถูกลบแล้ว');
    }
}
