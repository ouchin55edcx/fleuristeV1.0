<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});


//categories route 
Route::resource('dashboard', dashboardController::class);
Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
