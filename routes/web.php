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
   return view('lab.lab2');
});

//
//Route::get('login', function () {
//    return redirect('/');
//
//});

Route::get('login', 'Auth\LoginController@showLoginForm');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::resource('/lab', 'LabController');
    Route::get('/lab/{lab}/room', 'LabController@getroom')->name('lab.room');
	Route::post('lab/{lab}/createInstance', 'LabController@createInstance')->name('lab.createInstance');
	Route::post('lab/{lab}/createSubnet', 'LabController@createSubnet')->name('lab.createSubnet');
	Route::post('lab/{lab}/createRouter', 'LabController@createRouter')->name('lab.createRouter');

    Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
        Route::resource('lab', 'LabController');
        Route::post('lab/{lab}/togglePublishStatus', 'LabController@togglePublishStatus')->name('lab.togglePublishStatus');
        Route::get('lab/{lab}/prepare', 'LabController@prepare')->name('lab.prepare');
        Route::post('lab/{lab}/createInstance', 'LabController@createInstance')->name('lab.createInstance');
        Route::post('lab/{lab}/createSubnet', 'LabController@createSubnet')->name('lab.createSubnet');
        Route::post('lab/{lab}/createRouter', 'LabController@createRouter')->name('lab.createRouter');
        Route::patch('lab/{lab}/updateQuota', 'LabController@updateQuota')->name('lab.updateQuota');
        Route::post('lab/{lab}/uploadMaterial', 'LabController@uploadMaterial')->name('lab.uploadMaterial');
        Route::get('lab/{lab}/openConsole', 'LabController@openConsole')->name('lab.openConsole');

        Route::resource('image', 'ImageController', ['only' => ['index', 'store', 'destroy']]);
        Route::resource('flavor', 'FlavorController', ['only' => ['index', 'store', 'destroy']]);
        Route::resource('monitor', 'MonitorController', ['only' => ['index']]);
    });
});