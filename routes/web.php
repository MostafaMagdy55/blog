<?php

use Illuminate\Support\Facades\Route;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;

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

Route::get('/','FrontendController@index' );

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin' ,'middleware'=>'auth'], function () {


    Route::get('posts/trashed','PostController@trashed')->name('posts.trashed');
    Route::get('posts/restore/{id}','PostController@restore')->name('posts.restore');
    Route::get('posts/forcedelete/{id}','PostController@kill')->name('posts.kill');
    Route::get('user/admin/{id}', 'UserController@admin')->name('user.admin');
    Route::get('user/not-admin/{id}','UserController@not_admin')->name('user.not.admin');

    Route::get('user/profile', [
        'uses' => 'ProfileController@index',
        'as' => 'user.profile'
    ]);


    Route::post('/user/profile/update', [
        'uses' => 'ProfileController@update',
        'as' => 'user.profile.update'
    ]);


    Route::get('/settings', [
        'uses' => 'SettingsController@index',
        'as' => 'settings'
    ]);

    Route::post('/settings/update', [
        'uses' => 'SettingsController@update',
        'as' => 'settings.update'
    ]);
    Route::get('/post/{slug}', [
        'uses' => 'FrontEndController@singlepost',
        'as' => 'post.single'
    ]);

    Route::get('/category/{id}', [
        'uses' => 'FrontEndController@category',
        'as' => 'category.single'
    ]);

    Route::get('/tag/{id}', [
        'uses' => 'FrontEndController@tag',
        'as' => 'tag.single'
    ]);

    Route::get('result','FrontEndController@search')->name('result');


   Route::resource('users', 'UserController');
    Route::resource('posts', 'PostController');
    Route::resource('categories', 'CategoryController');
    Route::resource('tags', 'TagController');




});

