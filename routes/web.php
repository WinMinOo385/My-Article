<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\HomeController;



Route::get('/', [HomeController::class, 'landing']);
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');



//========== Start Article Routes ==========


Route::get('/articles', [ArticlesController::class, 'index']);
Route::get('/articles/add', [ArticlesController::class, 'add']);
Route::post('/articles/add', [ArticlesController::class, 'create']);
Route::get('/articles/detail/{id}', [ArticlesController::class, 'detail']);
Route::get('/articles/delete/{id}', [ArticlesController::class, 'delete']);
Route::get('/articles/edit/{id}', [ArticlesController::class, 'edit']);
Route::post('/articles/edit/{id}', [ArticlesController::class, 'edit']);


//========== End Article Routes ==========

//========== Start Comments Routes ==========


// Route::get('/comments', [CommentsController::class, 'index']);
Route::post('/comments/add', [CommentsController::class, 'add']);
Route::get('/comments/delete/{id}', [CommentsController::class, 'delete']);

//========== End Comments Routes ==========