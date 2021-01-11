<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\InstanceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmprestimoController;
use App\Http\Controllers\LoginController;

Route::get('/', [RecordController::class,'index'])->name('home');
Route::get('/home', [RecordController::class,'index']);

// Login
Route::get('login', [LoginController::class, 'redirectToProvider']);
Route::get('callback', [LoginController::class, 'handleProviderCallback']);
Route::post('logout', [LoginController::class, 'logout']);

// Rotas para Record
Route::resource('records', RecordController::class);

// Rotas para Instance
Route::resource('instances', InstanceController::class)->except(['create']);
Route::get('instances/create/{record}', [InstanceController::class,'create'])->name('instances.create');

// Rotas para Users
Route::resource('users', UserController::class);

// Rotas para Emprestimo
Route::resource('emprestimos', EmprestimoController::class)->except(['create']);
Route::get('emprestimos/create/{instance}', [EmprestimoController::class, 'create'])->name('emprestimos.create');

