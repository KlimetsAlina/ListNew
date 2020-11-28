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

Route::get('/films', 'ContentController@getFilms');
Route::get('/serials', 'ContentController@getSerials');
Route::get('/books', 'ContentController@getBooks');
Route::get('/music', 'ContentController@getMusic');
Route::get('/other', 'ContentController@getOther');
