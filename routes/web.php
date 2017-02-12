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

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/forgotpassword', function () {
    return view('forgotpassword');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/gethelp', function () {
    return view('gethelp');
});

Route::get('/providehelp', function () {
    return view('providehelp');
});

Route::get('/matching', function () {
    return view('matching');
});

Route::get('/myref', function () {
    return view('myref');
});

Route::get('/account', function () {
    return view('account');
});
