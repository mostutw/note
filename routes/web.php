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
        Route::get('demo4', 'DemoController@demo4');
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

        Route::get('users', 'UserController@index')->middleware('can:admin');
        Route::get('users/create', 'UserController@create')->middleware('can:admin');
        Route::post('users', 'UserController@store')->middleware('can:admin');
        Route::get('users/{id}', 'UserController@show')->middleware('can:admin');
        Route::get('users/{id}/edit', 'UserController@edit')->middleware('can:admin');
        Route::put('users/{id}', 'UserController@update')->middleware('can:admin');
 
        Route::get('resumes', 'ResumeController@index');
        Route::get('resumes/create', 'ResumeController@create');
        Route::post('resumes', 'ResumeController@store');
        Route::get('resumes/{id}', 'ResumeController@show');
        Route::get('resumes/{id}/edit', 'ResumeController@edit');
        Route::put('resumes/{id}', 'ResumeController@update');
        Route::get('resumes/{id}/export', 'ResumeController@export');
        Route::post('resumes/{id}/updateLock', 'ResumeController@updateLock');
    });

});
// 公開履歷表 ,唯一URL, 未上鎖時可編輯

Route::group(['prefix' => 'public'], function () {
    Route::get('resumes/{uuid}/edit', 'ResumeController@editForPublic');
    Route::put('resumes/{uuid}', 'ResumeController@updateForPublic'); 
});