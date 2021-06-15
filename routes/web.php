<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\InstanceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmprestimoController;

Route::get('/', [RecordController::class,'index'])->name('home');
Route::get('/home', [RecordController::class,'index']);

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

