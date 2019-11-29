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
        Route::get('login/github',function () {
            return Socialite::with('github')->redirect();
        })->name('githubLogin');
        Route::get('login/github/callback', function () {
            $user = Socialite::driver('github')->user();
            $createdUser = \App\User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => '',
                'email_verified_at' => date("Y-m-d H:i:s"),
            ]);
            auth()->login($createdUser, true);
            return redirect()->route('home');
        })->name('githubLoginCallback');

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
