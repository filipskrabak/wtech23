<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// TODO: replace with actual controllers

Route::get('/', function () {
    return view('index');
});

Route::get('/cart', [CartController::class, 'index']);

// Get all products with filters
Route::get('/products', [ProductController::class, 'index']);

// Single product
Route::get('/product/{product}', [ProductController::class, 'show']);

// Show register form (create user)
Route::get('/register', [UserController::class, 'create']);

// Create new user
Route::post('/users', [UserController::class, 'store']);

// Logout user
Route::post('/logout', [UserController::class, 'logout']);

// Show login form
Route::get('/login', [UserController::class, 'login']);

// Login user
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

// Show user orders
Route::get('/orders', [OrderController::class, 'show']);

//Edit user details
Route::get('/edit', [UserController::class, 'edit']);
