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


Route::prefix('post')->group( function (){
    //post
    Route::get('/','PostController@index')->name('posts');
    Route::get('/create','PostController@create')->name('add');
    Route::post('/store','PostController@store')->name('store');
    Route::get('/edit/{id}','PostController@edit')->name('edit');
    Route::patch('/update/{id}','PostController@update')->name('update');
    Route::get('/delete/{id}','PostController@delete')->name('delete');
    Route::get('/destroy/{id}','PostController@destroy')->name('destroy');
});

//category
Route::get('categories','CategoryController@index')->name('categories');
Route::get('categories/create','CategoryController@create')->name('create');
Route::post('categories','CategoryController@store')->name('categories.store');
Route::get('category/edit/{id}','CategoryController@edit')->name('category/edit');
Route::patch('category/update/{id}','CategoryController@update')->name('category/update');
Route::get('category/del/{id}','CategoryController@delete')->name('category/delete');
Route::get('category/destroy/{id}','CategoryController@destroy')->name('category/destroy');

Auth::routes();

//user
Route::get('/users','UserController@index')->name('users');
Route::get('/users/create','UserController@create')->name('users.create');
Route::post('/users','UserController@store')->name('users.store');
Route::get('/users/edit/{id}','UserController@edit')->name('users.edit');
Route::patch('/users/update/{id}','UserController@update')->name('users.update');
Route::patch('/users/inactive/{id}','UserController@inactive')->name('users.inactive');
Route::delete('/users/destroy/{id}','UserController@destroy')->name('users.destroy');

Route::get('/home', 'HomeController@index')->name('home');
