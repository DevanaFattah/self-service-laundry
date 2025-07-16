<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\LaundryController;
use App\Http\Controllers\TransactionController;
use App\Http\Middleware\isAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('v1')->group(function ($route) {

    Route::middleware('guest')->get('/', [AuthController::class, 'index'])->name('login');
    Route::middleware('guest')->post('/auth', [AuthController::class, 'auth'])->name('auth');
    Route::middleware('guest')->get('/register', [AuthController::class, 'index'])->name('register');
    
    Route::middleware('auth')->group(function () {
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [LaundryController::class, 'index'])->name('dashboard')->middleware(isAdmin::class);
        Route::get('/dashboard/add-user', [LaundryController::class, 'addUser'])->name('add-user')->middleware(isAdmin::class);
        Route::post('/dashboard/add-user', [LaundryController::class, 'storeUser'])->name('store-user')->middleware(isAdmin::class);
        Route::get('/dashboard/edit-user/{id}', [LaundryController::class, 'editUser'])->name('edit-user')->middleware(isAdmin::class);
        Route::put('/dashboard/update-user/{id}', [LaundryController::class, 'updateUser'])->name('update-user')->middleware(isAdmin::class);
        Route::get('/order', [LaundryController::class, 'order'])->name("order");
        Route::resource('transaction', TransactionController::class);
        Route::put('transaction/cancel-order/{id}', [TransactionController::class, 'cancelOrder'])->name('transaction.cancelOrder');
        Route::put('transaction/confirm-order/{id}', [TransactionController::class, 'confirmOrder'])->name('transaction.confirmOrder');
        Route::get('transaction/user-order/{id}', [TransactionController::class, 'userOrder'])->name('transaction.user-order');
        // Route::get('/transaction', TransactionController::class);
            // ->get('dashboard', [LaundryController::class, 'index'])->name("main");
    });
});