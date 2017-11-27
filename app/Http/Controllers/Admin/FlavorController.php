<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class FlavorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Cache::Forget('os.flavors');
        $flavors = Cache::rememberForever('os.flavors', function() {
            return json_decode(json_encode(iterator_to_array(resolve('OpenStackApi')->computeV2(['region' => 'RegionOne'])->listFlavors([], function ($flavor) {
                return $flavor;
            }, true))));
        });

        return view('admin.flavor.index', compact('flavors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
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

        Cache::Forget('os.flavors');

        return redirect(route('admin.flavor.index'));
    }
}
