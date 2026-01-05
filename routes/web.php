<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;


Route::get('/', [DashboardController::class, 'home'])->name('dashboard.home');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('/login', [AuthController::class, 'loginSumbit'])->name('auth.loginSubmit');
Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
