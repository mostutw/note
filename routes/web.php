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
    return redirect()->route('home');
});

Auth::routes();

Route::middleware('auth')->group(function () {

    Route::get('home', 'HomeController@index')->name('home');

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

        Route::get('users', 'UserController@index');
        Route::get('users/create', 'UserController@create');
        Route::post('users', 'UserController@store');
        Route::get('users/{id}', 'UserController@show');
        Route::get('users/{id}/edit', 'UserController@edit');
        Route::put('users/{id}', 'UserController@update');
 
        Route::get('resumes', 'ResumeController@index');
        Route::get('resumes/create', 'ResumeController@create');
        Route::post('resumes', 'ResumeController@store');
        Route::get('resumes/{id}', 'ResumeController@show');
        Route::get('resumes/{resume}/edit', 'ResumeController@edit');
        Route::put('resumes/{resume}', 'ResumeController@update');
        Route::get('resumes/{id}/export', 'ResumeController@export');
        Route::put('resumes/{id}/updateLock', 'ResumeController@updateLock');
        Route::put('resumes/{id}/updateProfile', 'ResumeController@updateProfile');

        Route::get('flows', 'FlowController@index');
        Route::get('flows/{id}/showStep', 'FlowController@flowStep');
        Route::put('flows/{id}/updateStep', 'FlowController@flowUpdate');

        Route::get('forms/{id}', 'FormController@show');
        Route::get('forms/{itecformdata}/edit', 'FormController@edit');
        Route::put('forms/{id}', 'FormController@update');     
    });

});

Route::group(['prefix' => 'public'], function () {
    Route::get('resumes/{uuid}/edit', 'ResumeController@editForPublic');
    Route::put('resumes/{uuid}', 'ResumeController@updateForPublic'); 
});