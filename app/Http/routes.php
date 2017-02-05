<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('index');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/profiles', function () {
    return view('profiles');
});
Route::get('/register', function () {
    return view('register');
});
Route::get('/single', function () {
    return view('single');
});
Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/chats', function () {
    return view('chat');
});

Route::post('/signin', 'AuthController@login');