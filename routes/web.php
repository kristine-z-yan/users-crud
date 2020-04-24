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

Route::get('/', 'UserController@index')->name('index');
Route::get('/create', 'UserController@create')->name('create');
Route::post('/', 'UserController@store')->name('store');
Route::get('/{id}/edit', 'UserController@edit')->name('edit');
Route::put('/{id}', 'UserController@update')->name('update');
Route::delete('/{id}', 'UserController@destroy');

