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

Route::get('/', 'HomeController@index');

Route::get('/mailCheck', 'HomeController@mailCheck');


Route::get('/got', [
  'middleware' => ['auth'],
  'uses' => function () {
   echo "You are allowed to view this page!";
}]);



Auth::routes();
Route::get('/home', 'HelpController@index');

// Account
Route::get('/account', 'AccountController@index');
Route::post('/account/add', 'AccountController@add');
Route::post('/account/update', 'AccountController@update');
Route::get('/account/edit', 'AccountController@edit');


// User
Route::get('/users', 'UserController@index');

Route::get('/usersmail', 'UserController@usersmail');
Route::post('/addTestimonial', 'UserController@addTestimonial');




// GetHelp
Route::get('/gethelp', 'HelpController@gethelp');

// ProvideHelp
Route::get('/providehelp', 'HelpController@providehelp');

Route::post('/acceptProvideHelp', 'HelpController@acceptProvideHelp');
Route::post('/makeMemberToGetHelp', 'HelpController@makeMemberToGetHelp');
Route::post('/ackTheHelp', 'HelpController@ackTheHelp');
Route::post('/acceptGetHelp', 'HelpController@acceptGetHelp');




// Matching
Route::get('/matching', 'HelpController@matching');
Route::post('/MatchUser', 'HelpController@MatchUser');

Route::post('/uploadProof', 'HelpController@uploadProof');


//Images

Route::get('proofimages/{filename}', function ($filename)
{
    $path = storage_path() . '/proof_uploads/' . $filename;

    if(!File::exists($path)) abort(404);

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});




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

