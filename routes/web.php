<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartProductController;
use App\Http\Controllers\DashboardProductController;
use App\Policies\User;

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

// Show cart
Route::get('/cart', [CartProductController::class, 'index']);

// Show checkout
Route::get('/checkout', [CheckoutController::class, 'create']);

// Get all products with filters
Route::get('/products', [ProductController::class, 'index']);

// Single product
Route::get('/product/{product:slug}', [ProductController::class, 'show']);

// Create new product view
Route::get('/dashboard/products/create', [DashboardProductController::class, 'create'])->can('admin', User::class);

// Store single product
Route::post('/dashboard/products', [DashboardProductController::class, 'store'])->can('admin', User::class);

// Edit single product
Route::get('/dashboard/products/{product:slug}/edit', [DashboardProductController::class, 'edit'])->can('admin', User::class);

// Update single product
Route::put('/dashboard/products/{product:slug}', [DashboardProductController::class, 'update'])->can('admin', User::class)->name('products.update');

// Store image for product
Route::post('/dashboard/products/create-image', [DashboardProductController::class, 'storeImage'])->can('admin', User::class);

// Destroy image
Route::delete('/dashboard/products/destroy-image', [DashboardProductController::class, 'destroyImage'])->can('admin', User::class);

// Show register form (create user)
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// Create new user
Route::post('/users', [UserController::class, 'store']);

// Logout user
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Show login form
Route::get('/login', [UserController::class, 'login'])->middleware('guest')->name('login');

// Login user
Route::post('/users/authenticate', [UserController::class, 'authenticate'])->middleware('guest');

// Show user orders
Route::get('/orders', [OrderController::class, 'show'])->middleware('auth');

//Show edit user details from
Route::get('/edit', [UserController::class, 'edit'])->middleware('auth');

//Edit user details
Route::post('/edit/details', [UserController::class, 'editDetails'])->middleware('auth');

//Edit user password
Route::post('/edit/password', [UserController::class, 'editPassword'])->middleware('auth');

// Add Product to Cart
Route::post('/cart/{id}', [CartProductController::class, 'store']);

// Remove Product from Cart
Route::delete('/cart/{id}', [CartProductController::class, 'destroy']);

// Update Product in Cart
Route::put('/cart/{id}', [CartProductController::class, 'update']);

// Create new order
Route::post('/orders', [OrderController::class, 'store']);

// TODO: Show order
