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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', [
    'uses'=>'BlogController@index',
    'as'=>'blog',
]);

Route::get('/{post}', [
    'uses'=>'BlogController@show',
    'as'=>'show',
]);

Route::get('/category/{category}', [
    'uses'=>'BlogController@category',
    'as'=>'category',
]);

Route::get('/author/{author}', [
    'uses'=>'BlogController@author',
    'as'=>'author',
]);

Route::get('admin/posts/create','Backend\BlogController@create' );

Route::get('admin/posts/{id}','Backend\BlogController@show' );

Route::get('admin/posts/{id}/edit','Backend\BlogController@edit' );

Route::put('admin/posts/{id}','Backend\BlogController@update' );

Route::delete('admin/posts/{id}','Backend\BlogController@destroy' );

Route::put('post/restore/{id}', [
    'uses'=>'Backend\BlogController@restore',
    'as'=>'post.restore',
]);

Route::delete('post/force-destroy/{id}', [
    'uses'=>'Backend\BlogController@forceDestroy',
    'as'=>'post.force-destroy',
]);

Route::resource('/admin/posts','Backend\BlogController');