<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\EnsureSessionIsValid;
use Illuminate\Support\Facades\Route;

Route::middleware([EnsureSessionIsValid::class])->group(function () {
    Route::prefix('auth')->group(function () {
        Route::prefix('login')->group(function () {
            Route::get('/', [AuthController::class, 'login'])->name('login');
            Route::post('/', [AuthController::class, 'doLogin'])->name('login');
        });

        Route::prefix('change-password')->group(function () {
            Route::get('/', [AuthController::class, 'changePassword'])->name('auth-change-password');
            Route::post('/', [AuthController::class, 'doChangePassword'])->name('auth-change-password');
        });

        Route::get('/logout', [AuthController::class, 'doLogout'])->name('logout');
    });
});
