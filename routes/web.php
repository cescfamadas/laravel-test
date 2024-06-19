<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\PostController;

Route::view('/', 'welcome');
Route::view('/hola', 'hola');
Route::resource('posts', PostController::class);
