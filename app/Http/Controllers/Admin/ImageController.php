<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = resolve('OpenStackApi')->imagesV2()->listImages();

        return view('admin.image.index', compact('images'));
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
//        dd($request->file('image_file'));

        $openStack = resolve('OpenStackApi');
        $imageService = $openStack->imagesV2();

        $image = $imageService->createImage([
            'name'            => $request->name,
            'diskFormat'      => $request->disk_format,
            'containerFormat' => 'bare',
            'visibility'      => 'public',
            'minDisk'         => 0,
            'protected'       => false,
            'minRam'          => 0,
        ]);

        $image  = $imageService->getImage($image->id);
        $stream = \GuzzleHttp\Psr7\stream_for(fopen($request->file('image_file'), 'r'));
        $image->uploadData($stream);

        return redirect(route('admin.image.index'))->with('alert_success', 'อัพโหลดอิมเมจสำเร็จ');
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
        resolve('OpenStackApi')->imagesV2()->getImage($id)->delete();

        Cache::forget('os.images');

        return redirect(route('admin.image.index'));
    }
}
