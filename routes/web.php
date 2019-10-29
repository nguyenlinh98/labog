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
Route::prefix('post')->group(function () {
    //post
    Route::get('/', 'PostController@index')->name('posts');
    Route::get('/create', 'PostController@create')->name('add');
    Route::post('/store', 'PostController@store')->name('store');
    Route::get('/show/{id}', 'PostController@show')->name('show');
    Route::get('/edit/{id}', 'PostController@edit')->name('edit');
    Route::patch('/update/{id}', 'PostController@update')->name('update');
    Route::get('/inactive/{id}', 'PostController@inactive')->name('inactive');
    Route::delete('/destroy/{id}', 'PostController@destroy')->name('destroy');
    Route::patch('/inactiveAll', 'PostController@inactiveAll')->name('inactiveAll');
    Route::get('/search', 'PostController@search')->name('search');
});

//category
Route::get('categories', 'CategoryController@index')->name('categories');
Route::get('categories/create', 'CategoryController@create')->name('create');
Route::post('categories', 'CategoryController@store')->name('categories.store');
Route::get('category/edit/{id}', 'CategoryController@edit')->name('category.edit');
Route::patch('category/update/{id}', 'CategoryController@update')->name('category.update');
Route::get('category/inactive/{id}', 'CategoryController@inactive')->name('category.inactive');
Route::delete('category/destroy', 'CategoryController@destroy')->name('category.destroy');
// delete all multiple record
Route::patch('category/inactiveAll','CategoryController@inactiveAll');
Auth::routes();

//user
Route::get('/users', 'UserController@index')->name('users');
Route::get('/users/create', 'UserController@create')->name('users.create');
Route::post('/users', 'UserController@store')->name('users.store');
Route::get('/users/edit/{id}', 'UserController@edit')->name('users.edit');
Route::patch('/users/update/{id}', 'UserController@update')->name('users.update');
Route::patch('/users/inactive/{id}', 'UserController@inactive')->name('users.inactive');
Route::delete('/users/destroy/{id}', 'UserController@destroy')->name('users.destroy');
Route::patch('/users/deleteAll','UserController@deleteAll')->name('users.deleteAll');

Route::get('/profile', 'UserController@profile')->name('profile');
Route::patch('/profile/update', 'UserController@updateProfile')->name('profile.update');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/tags','TagController@index')->name('tags');
Route::post('/tags','TagController@store')->name('tag.store');

Route::get('/redirect/{social}','SocialAuthController@redirectToProvider');
Route::get('/callback/{social}','SocialAuthController@handleProviderCallback');

// token active before login
Route:: get('/activation/{token}','Auth\LoginController@activation')->name('activation')->middleware('signed');
