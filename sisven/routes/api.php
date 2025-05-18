<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\CustomersController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/customers', [CustomersController::class, 'index'])->name('customers');
Route::post('/customers', [CustomersController::class, 'store'])->name('customers.store');
Route::get('/customers/{customer}', [CustomersController::class, 'show'])->name('customers.show');
Route::put('/customers/{customer}', [CustomersController::class, 'update'])->name('customers.update');
Route::delete('/customers/{customer}', [CustomersController::class, 'destroy'])->name('customers.destroy');