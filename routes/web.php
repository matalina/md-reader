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

Route::get('/','PageController@show');

Route::get('login/github', 'Auth\GithubController@redirectToProvider')->name('login.github');
Route::get('login/github/callback', 'Auth\GithubController@handleProviderCallback');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/page/{page}', 'PageController@show')->name('page');