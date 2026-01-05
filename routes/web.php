<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;


Route::get('/', [DashboardController::class, 'home'])->name('dashboard.home');

//Auth Routes
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('/login', [AuthController::class, 'loginSumbit'])->name('auth.loginSubmit');
Route::get('/login', [AuthController::class, 'login'])->name('auth.login');

//Dashboard Routes
Route::prefix('/dashboard')->name('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('/new_users', [DashboardController::class, 'new_users'])->name('new_users');
    Route::get('inactive_users', [DashboardController::class, 'inactive_users'])->name('inactive_users');
    Route::get('payments', [DashboardController::class, 'payments'])->name('payments');
});
