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

// Before login menu For welcome pages link  
Route::get('/', function () {
    return view('welcome');
});
Route::get('/contact-us', 'FrontViewController@contact');
Route::get('/Abouts', 'FrontViewController@aboutPage');


// After login menu for user home pages link
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

// profile section
Route::get('/Profile', 'ProfileController@profile');
Route::get('/Profile', 'ProfileController@profile');
Route::get('/Profile-edit/{id}', 'ProfileController@profileedit');
Route::put('/Profile-update/{id}', 'ProfileController@profileUpdate');

// reading section
Route::get('/Reading', 'PostController@post');
Route::get('/showreading/{id}', 'PostController@show');

// practice section
// Route::get('/Practice', 'HomeController@practice');
Route::auth();
Route::group(['prefix' => 'Pquizzes'], function () {
    Route::get('/indexs', 'PracticeController@index');
    Route::get('/create', 'PracticeController@create');
    Route::post('/', 'PracticeController@store');
    Route::get('/{quiz}', 'PracticeController@show');
    Route::post('/{quiz}', 'PracticeController@result');
    Route::delete('/{quiz}', 'PracticeController@destroy');
});

// For Exam Section
Route::auth();
Route::group(['prefix' => 'quizzes'], function () {
    Route::get('/index', 'QuizController@index');
    Route::get('/create', 'QuizController@create');
    Route::post('/', 'QuizController@store');
    Route::get('/{quiz}', 'QuizController@show');
    Route::post('/{quiz}', 'QuizController@result');
    Route::delete('/{quiz}', 'QuizController@destroy');
});
	
// For Admin Dashboard
Route::group(['middleware' => ['auth','admin']], function (){
	Route::get('/Admin', function(){
		return view('admin.dashboard');

    });

// For Users Section
Route::get('/registered','Admin\DashboardController@registered');
Route::get('/role-edit/{id}','Admin\DashboardController@registeredEdit');
Route::put('/registered-update/{id}','Admin\DashboardController@registeredUpdate');
Route::delete('/role-delete/{id}','Admin\DashboardController@registeredDelete');

// For Reading Section
Route::get('/abouts','Admin\AboutusController@index');
Route::post('/save-aboutus','Admin\AboutusController@store');
Route::resource('/abouts','Admin\AboutusController');
Route::get('/about-us/{id}','Admin\AboutusController@edit');
Route::put('/about-us-update/{id}','Admin\AboutusController@update');
Route::resource('/about-us','Admin\AboutusController');
Route::delete('/about-us-delete/{id}','Admin\AboutusController@delete');

});

//For Quiz Section

