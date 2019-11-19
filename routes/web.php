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
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function () {
    // Authentication Routes...
        Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
        Route::post('login', 'Auth\LoginController@login');
        Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    // Registration Routes...
        Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('register');
        Route::post('signup', 'Auth\RegisterController@register');

    // Password Reset Routes...
        Route::resetPassword();

    // Password Confirmation Routes...
        Route::confirmPassword();

    // Email Verification Routes...
        Route::emailVerification();
});

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
