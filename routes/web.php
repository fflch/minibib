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

// Rotas para Record
Route::resource('/records','RecordController');

// Rotas para Instance
Route::resource('/instance','InstanceController')->except(['create']);
// Rota para Instance que recebe o id do record
Route::get('/instance/create/{record}','InstanceController@create')->name('instance.create');

// Rotas para Users
Route::resource('/users', 'UserController');
