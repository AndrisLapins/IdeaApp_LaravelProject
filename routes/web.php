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

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');

Route::resource('comments', 'CommentsController');
Route::resource('posts', 'PostsController');

Route::get('/comments/create/{post_id}', 'CommentsController@create');
Route::get('comments/{post_id}/edit','CommentsController@edit');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
Route::delete('/dashboard/{user}', 'AdminsController@destroy');

Route::get('/search','PostsController@search');
Route::get('/returnall','PostsController@index');

//Route::put('/favorites','FavoritesController@add');