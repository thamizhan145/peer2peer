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

Route::get('/', 'ListController@show');

Route::get('/got', [
  'middleware' => ['auth'],
  'uses' => function () {
   echo "You are allowed to view this page!";
}]);

Auth::routes();
Route::get('/home', 'HomeController@index');

// Account
Route::get('/account', 'AccountController@index');
Route::post('/account/add', 'AccountController@add');
Route::post('/account/update', 'AccountController@update');
Route::get('/account/edit', 'AccountController@edit');


// User
Route::get('/users', 'UserController@index');


// GetHelp
Route::get('/gethelp', 'UserController@gethelp');



/*
Route::get('/', function () {
    return view('terms_condit');
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
*/

