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

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('home');
});

Auth::routes();


Route::middleware('auth')->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['prefix' => 'demo'], function () {
        Route::get('demo', 'DemoController@index');
        Route::get('demo2', 'DemoController@demo2');
        Route::get('demo3', 'DemoController@demo3');
    });

    Route::group(['prefix' => 'pages'], function () {
        Route::get('maintains', 'MaintainController@index');
        Route::get('maintains/create', 'MaintainController@create');
        Route::post('maintains', 'MaintainController@store');
    });
});
