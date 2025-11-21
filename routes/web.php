<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::redirect('/', '/dashboard');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin Only Routes
    Route::middleware(['admin'])->group(function () {
        Route::get('/suppliers-list', [DashboardController::class, 'suppliers'])->name('suppliers-list');
        Route::get('/products-list', [DashboardController::class, 'products'])->name('products-list');
        Route::get('/categories-list', [DashboardController::class, 'categories'])->name('categories-list');

        Route::resource('suppliers', SupplierController::class);
        Route::resource('products', ProductController::class);
        
        // Category routes with product management
        Route::resource('categories', CategoryController::class)->except('destroy');
        Route::get('/categories/{category}/manage-products', [CategoryController::class, 'manageProducts'])->name('categories.manage-products');
        Route::post('/categories/{category}/add-product', [CategoryController::class, 'addProduct'])->name('categories.add-product');
        Route::delete('/categories/{category}/remove-product/{product}', [CategoryController::class, 'removeProduct'])->name('categories.remove-product');
        
        Route::resource('employees', EmployeeController::class);
    });

    // Cashier Routes (Can access transactions)
    Route::middleware(['cashier'])->group(function () {
        Route::resource('transactions', TransactionController::class);
    });
});
