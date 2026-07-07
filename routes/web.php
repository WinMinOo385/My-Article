<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Articles;

Route::get('/', [Controller::class, 'index']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



//========== Start Article CRUD Routes ==========

Route::get('/articles', [Articles::class, 'index']);
Route::get('/articles/detail/{id}', [Articles::class, 'detail']);
Route::get('/articles/add', [Articles::class, 'add']);
Route::post('/articles/add', [Articles::class, 'create']);

//========== End Article CRUD Routes ==========