<?php

use App\Policies\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CartProductController;
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\DashboardAttributeValueController;

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

//User controller routes
Route::controller(UserController::class)->group(function (){

    Route::middleware('guest')->group(function () {
        // Show register form (create user)
        Route::get('/register', 'create');

        // Show login form
        Route::get('/login', 'login')->name('login');

        // Login user
        Route::post('/users/authenticate', 'authenticate');

        // Create new user
        Route::post('/users', 'store');
    });

    Route::middleware('auth')->group(function () {
        // Logout user
        Route::post('/logout', 'logout');

        //Show edit user details from
        Route::get('/edit', 'edit');

        //Edit user details
        Route::post('/edit/details', 'editDetails');

        //Edit user password
        Route::post('/edit/password', 'editPassword');
    });
});

//ProductController routes
Route::controller(ProductController::class)->group(function () {
    // Get all products with filters
    Route::get('/products', 'index');

    // Single product
    Route::get('/product/{product:slug}', 'show');
});

//CartProductController routes
Route::controller(CartProductController::class)->group(function () {
    // Show cart
    Route::get('/cart', 'index');

    // Add Product to Cart
    Route::post('/cart/{id}', 'store');

    // Remove Product from Cart
    Route::delete('/cart/{id}', 'destroy');

    // Update Product in Cart
    Route::put('/cart/{id}', 'update');
});

// Show checkout
Route::controller(CheckoutController::class)->group(function () {
    // Show checkout
    Route::get('/checkout', 'index');

    // check if postcode is valid
    Route::post('/checkout/postcode', 'checkPostcode');

    // check if street is valid
    Route::post('/checkout/street', 'checkStreet');
});

//OrderController routes
Route::controller(OrderController::class)->group(function () {
    // Show user orders
    Route::get('/orders', 'index')->middleware('auth')->name('orders.index');

    // Show order details
    Route::get('/orders/{order}', 'show')->name('orders.show');

    // Create new order
    Route::post('/orders', 'store');
});

//Admin routes
Route::middleware('can:admin, App\Models\User')->group(function () {

    //OrderController routes
    Route::controller(OrderController::class)->group(function () {
        // Update order status
        Route::put('/dashboard/orders/{order}', 'update')->name('dashboard.orders.update');

        // Delete order
        Route::delete('/dashboard/orders/{order}', 'destroy')->name('dashboard.orders.destroy');
    });

    // Admin User routes
    Route::controller(UserController::class)->group(function () {
        //Change user role
        Route::put('/users/{user:id}/role', 'changeRole');

        // Delete user
        Route::delete('/users/{user}', 'destroy');
    });

    //DashboardController routes
    Route::controller(DashboardController::class)->group(function () {

        // Show all products
        Route::get('/dashboard/products', 'products');

        //Show all users
        Route::get('/dashboard/users', 'users')->name('dashboard.users.index');

        // Show all attribute values
        Route::get('/dashboard/attribute-values', 'attributes')->name('dashboard.attribute-values.index');

        //Show all orders
        Route::get('/dashboard/orders', 'orders')->name('dashboard.orders.index');
    });

    //DashboardProductController routes
    Route::controller(DashboardProductController::class)->group(function () {

        // Create new product view
        Route::get('/dashboard/products/create',  'create');

        // Store single product
        Route::post('/dashboard/products', 'store');

        // Edit single product
        Route::get('/dashboard/products/{product:slug}/edit',  'edit');

        // Update single product
        Route::put('/dashboard/products/{product:slug}', 'update')->name('products.update');

        // Delete single product
        Route::delete('/dashboard/products/{product:slug}', 'destroy')->name('products.destroy');

        // Store image for product (session)
        Route::post('/dashboard/products/create-image', 'storeImage');

        // Destroy image (session)
        Route::delete('/dashboard/products/destroy-image', 'destroyImage');

        // Store image in the DB
        Route::post('/dashboard/products/{product:slug}/edit/create-image', 'storeImageDB')->name('products.storeImageDB');

        // Destroy image in the DB
        Route::delete('/dashboard/products/edit/destroy-image/{image}', 'destroyImageDB')->name('products.destroyImageDB');
    });

    //DashboardAttributeController routes
    Route::controller(DashboardAttributeValueController::class)->group(function () {

        // Create new attribute value view
        Route::get('/dashboard/attribute-values/create',  'create');

        // Store single attribute value
        Route::post('/dashboard/attribute-values', 'store');

        // Edit single attribute value
        Route::get('/dashboard/attribute-values/{attributeValue}/edit',  'edit');

        // Update single attribute value
        Route::put('/dashboard/attribute-values/{attributeValue}', 'update')->name('attribute-values.update');

        // Delete single attribute value
        Route::delete('/dashboard/attribute-values/{attributeValue}', 'destroy')->name('attribute-values.destroy');

    });
});

// Shipping methods page
Route::get('/shipping', function () {
    return view('shipping');
});

//Terms and conditions page
Route::get('/terms', function () {
    return view('terms');
});

//Payment methods page
Route::get('/payment', function () {
    return view('payment');
});

// TODO: Show order
