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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::post('/new_post_submit', 'HomeController@index_post')->name('new_post_submit');
Route::post('/new_sub_submit', 'HomeController@subscribe')->name('new_sub_submit');

Route::get('/newpost', 'NewPostController@index')->name('newpost');

Route::get('/post/{id}', 'PostController@index');
Route::post('/post/{id}', 'PostController@index_post');

Route::get('/sub', 'SubController@index')->name('sub');

Route::post('/cancelsub', 'SubController@cancel_sub')->name('cancel_sub');

Route::post('/new_like', 'LikeController@index')->name('new_like');
Route::post('/likes_getdata', 'LikeController@getData')->name('likes_getdata');