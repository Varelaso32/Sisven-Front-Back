<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\CustomersController;
use App\Http\Controllers\api\CategoriesController;
use App\Http\Controllers\api\PayModeController;
use App\Http\Controllers\api\ProductsController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rutas para customers
Route::get('/customers', [CustomersController::class, 'index'])->name('customers');
Route::post('/customers', [CustomersController::class, 'store'])->name('customers.store');
Route::get('/customers/{customer}', [CustomersController::class, 'show'])->name('customers.show');
Route::put('/customers/{customer}', [CustomersController::class, 'update'])->name('customers.update');
Route::delete('/customers/{customer}', [CustomersController::class, 'destroy'])->name('customers.destroy');

// Rutas para categories
Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');
Route::post('/categories', [CategoriesController::class, 'store'])->name('categories.store');
Route::get('/categories/{category}', [CategoriesController::class, 'show'])->name('categories.show');
Route::put('/categories/{category}', [CategoriesController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category}', [CategoriesController::class, 'destroy'])->name('categories.destroy');

// Rutas para pay modes
Route::get('/pay-modes', [PayModeController::class, 'index'])->name('pay_modes');
Route::post('/pay-modes', [PayModeController::class, 'store'])->name('pay_modes.store');
Route::get('/pay-modes/{pay_mode}', [PayModeController::class, 'show'])->name('pay_modes.show');
Route::put('/pay-modes/{pay_mode}', [PayModeController::class, 'update'])->name('pay_modes.update');
Route::delete('/pay-modes/{pay_mode}', [PayModeController::class, 'destroy'])->name('pay_modes.destroy');

// Rutas para products
Route::get('/products', [ProductsController::class, 'index'])->name('products');
Route::post('/products', [ProductsController::class, 'store'])->name('products.store');
Route::get('/products/{product}', [ProductsController::class, 'show'])->name('products.show');
Route::put('/products/{product}', [ProductsController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductsController::class, 'destroy'])->name('products.destroy');