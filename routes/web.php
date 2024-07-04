<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});


//categories route 
Route::resource('dashboard', dashboardController::class);
Route::resource('categories', CategoryController::class);
