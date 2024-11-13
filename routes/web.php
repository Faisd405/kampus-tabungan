<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SavingAccountController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class)->except(['show']);
    Route::resource('students', StudentController::class)->except(['show']);
    Route::resource('saving-account', SavingAccountController::class);
    Route::resource('saving-account.transaction', TransactionController::class)
        ->only(['store', 'update', 'destroy']);
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
});
