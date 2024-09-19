<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\InstanceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmprestimoController;
use App\Http\Controllers\StatisticController;

Route::get('/', [RecordController::class,'index'])->name('home');
Route::get('/home', [RecordController::class,'index']);

// Rotas para Record
Route::resource('records', RecordController::class);

// Rotas para Instance
Route::resource('instances', InstanceController::class)->except(['create']);
Route::get('instances/create/{record}', [InstanceController::class,'create'])->name('instances.create');

// Rotas para Emprestimo
Route::resource('emprestimos', EmprestimoController::class)->except(['create']);
Route::get('emprestimos/create/{instance}', [EmprestimoController::class, 'create'])->name('emprestimos.create');

//Rotas para Estatísticas
Route::get('/statistics', [StatisticController::class,'index']);

# Logs
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->middleware('can:admin');

Route::get('/statistics/excel/materiais', [StatisticController::class, 'exportarMaterial']);
Route::get('/statistics/excel/exemplares', [StatisticController::class, 'exportarExemplares']);
Route::get('/statistics/excel/materiais_completos', [StatisticController::class, 'exportarMateriaisCompletos']); 