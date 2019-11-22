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





    Route::get('/login', function () {
        return view('login');
    })->name('login');

    Route::post('/signup', [
        'uses' => 'UserController@postSignUp',
        'as' => 'signup'
    ]);

    Route::post('/signin', [
        'uses' => 'UserController@postSignIn',
        'as' => 'signin'
    ]);

    Route::get('/logout', [
        'uses' => 'UserController@postLogout',
        'as' => 'logout'
    ]);


    Route::get('/', [
        'uses' => 'PostController@home',
        'as' => 'home',
    ]);

    Route::get('/register', function () {
        return view('register');
    })->name('register');

    Route::post('/createPost', [
        'uses' => 'PostController@createPost',
        'as' => 'createPost',
        'middleware' => 'auth'
    ]);

    Route::get('/editPost/{post_id}', [
        'uses' => 'PostController@editPost',
        'as' => 'editPost',
        'middleware' => 'auth'
    ]);

    Route::get('/deletePost/{post_id}', [
        'uses' => 'PostController@deletePost',
        'as' => 'deletePost',
        'middleware' => 'auth'
    ]);

    Route::get('/profile/{username}', [
        'uses' => 'ProfileController@profile',
        'as' => 'profile',
        'middleware' => 'auth'
    ]);

    Route::get('/setup', [
        'uses' => 'ProfileController@setup',
        'as' => 'setup',
        'middleware' => 'auth'
    ]);

    Route::get('/browser', [
        'uses' => 'ProfileController@profileBrowser',
        'as' => 'profileBrowser',
        'middleware' => 'auth'
    ]);

    Route::post('/setupInfo', [
        'uses' => 'ProfileController@setupInfo',
        'as' => 'setupInfo',
        'middleware' => 'auth'
    ]);

    Route::post('/postFollowUnfollow', [
        'uses' => 'ProfileController@postFollowUnfollow',
        'as' => 'postFollowUnfollow',
        'middleware' => 'auth'
    ]);

