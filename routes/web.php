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
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
        Route::get('maintains/{id}', 'MaintainController@show');
        Route::get('maintains/{id}/edit', 'MaintainController@edit');
        Route::put('maintains/{id}', 'MaintainController@update');

        Route::get('change-password', 'ChangePasswordController@index');
        Route::put('change-password', 'ChangePasswordController@update');
    });

});
