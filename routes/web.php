<?php

use Illuminate\Support\Facades\Route;

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

Route::resource('threads', 'ThreadController');
Route::post('/replies/store', 'ReplyController@store')->name('replies.store');

Route::get('laravel-version', function() {
    $laravel = app();
    return "Your Laravel version is ".$laravel::VERSION;
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
