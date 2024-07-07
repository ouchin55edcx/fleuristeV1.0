<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\OrderController;

// Public routes
Route::get('/', [CategoryController::class, 'show'])->name('home');



//categories route 
Route::resource('dashboard', dashboardController::class);
Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);


// Authentication routes
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('dashboard', DashboardController::class)->except('index');
    Route::resource('categories', CategoryController::class);
});



Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::post('/order/add', [OrderController::class, 'add'])->middleware('auth')->name('cart.add');;


Route::get('panier', [OrderController::class,'showpanier']);

Route::post('/update-quantity', [OrderController::class, 'updateQuantity']);
Route::post('/checkout', [OrderController::class, 'checkout']);

Route::get('/search', [ProductController::class, 'search'])->name('products.search');

Route::get('/product-counts', [ProductController::class, 'getProductCounts']);


Route::get('/category/{id}', [CategoryController::class, 'showProducts'])->name('category.products');