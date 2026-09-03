<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Pelanggan //
Route::prefix('customer')->name('customer.')->group(function () {

    Route::middleware('guest:customer')->group(function () {
        Route::get('/register', [CustomerAuthController::class, 'showRegisterForm'])->name('register');
        Route::post('/register', [CustomerAuthController::class, 'register']);

        Route::get('/login', [CustomerAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [CustomerAuthController::class, 'login']);
    });

    Route::middleware('auth:customer')->group(function () {
        Route::post('/logout', [CustomerAuthController::class, 'logout'])->name('logout');


        Route::get('/home', [HomeController::class, 'index'])->name('home');

        Route::get('/about', [HomeController::class, 'about'])->name('about');

        Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
        Route::get('/catalog/{id}', [CatalogController::class, 'show'])->name('catalog.show');
        
        Route::get('/carts', [CartController::class, 'index'])->name('carts.index');
        Route::post('/carts/{product}', [CartController::class, 'store'])->name('carts.store');
        Route::patch('/carts/{cart}', [CartController::class, 'update'])->name('carts.update');
        Route::post('/carts/{product}/buy-now', [CartController::class, 'buyNow'])->name('carts.buyNow');
        Route::delete('/carts/{cart}', [CartController::class, 'destroy'])->name('carts.destroy');

        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
        Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
        Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');

        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');


        Route::get('/profile', [CustomerProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [CustomerProfileController::class, 'update'])->name('profile.update');
    });
});

// Admin //
Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login']);
    });

    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        Route::get('/dashboard', function () {
            return 'Halaman Dashboard Admin';
        })->name('dashboard');

        Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [AdminProfileController::class, 'update'])->name('profile.update');

        // Route for Admin
        Route::resource('/admin', App\Http\Controllers\AdminController::class);
        //Route for Customer
         Route::resource('/customers', App\Http\Controllers\CustomerController::class)->only(['index', 'show']);
         // Route for Product
        Route::resource('/products', App\Http\Controllers\ProductController::class);
    });
});