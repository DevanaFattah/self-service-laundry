<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\LaundryController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('v1')->group(function ($route) {

    Route::middleware('guest')->get('/', [AuthController::class, 'index'])->name('login');
    Route::middleware('guest')->post('/auth', [AuthController::class, 'auth'])->name('auth');
    Route::middleware('guest')->get('/register', [AuthController::class, 'index'])->name('register');

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [LaundryController::class, 'index'])->name('dashboard');
        Route::get('/order', [LaundryController::class, 'order'])->name("order");
        Route::resource('transaction', TransactionController::class);
        // Route::get('/transaction', TransactionController::class);
            // ->get('dashboard', [LaundryController::class, 'index'])->name("main");
    });
});