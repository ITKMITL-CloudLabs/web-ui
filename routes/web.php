<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test', function () {
   return view('lab.lab');
});

Route::get('/', function () {
    return view('auth.login');
});

Route::get('login', function () {
    return redirect('/');
});
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('/lab', 'LabController');

    Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
        Route::resource('lab', 'LabController');
        Route::post('lab/{lab}/togglePublishStatus', 'LabController@togglePublishStatus')->name('lab.togglePublishStatus');
        Route::get('lab/{lab}/prepare', 'LabController@prepare')->name('lab.prepare');
        Route::post('lab/{lab}/createInstance', 'LabController@createInstance')->name('lab.createInstance');
        Route::patch('lab/{lab}/updateQuota', 'LabController@updateQuota')->name('lab.updateQuota');
        Route::post('lab/{lab}/uploadMaterial', 'LabController@uploadMaterial')->name('lab.uploadMaterial');

        Route::resource('image', 'ImageController', ['only' => ['index', 'destroy']]);
        Route::resource('flavor', 'FlavorController', ['only' => ['index', 'store', 'destroy']]);
    });
});