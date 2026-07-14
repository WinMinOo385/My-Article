<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'landing']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



//========== Start Article Routes ==========

use App\Http\Controllers\Articles;

Route::get('/articles', [Articles::class, 'index']);
Route::get('/articles/add', [Articles::class, 'add']);
Route::post('/articles/add', [Articles::class, 'create']);
Route::get('/articles/detail/{id}', [Articles::class, 'detail']);
Route::get('/articles/delete/{id}', [Articles::class, 'delete']);

//========== End Article Routes ==========

//========== Start Comments Routes ==========

use App\Http\Controllers\Comments;

// Route::get('/comments', [Comments::class, 'index']);
Route::post('/comments/add', [Comments::class, 'add']);
Route::get('/comments/delete/{id}', [Comments::class, 'delete']);

//========== End Comments Routes ==========