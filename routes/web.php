<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\EnsureSessionIsValid;
use Illuminate\Support\Facades\Route;

Route::middleware([EnsureSessionIsValid::class])->group(function () {
    Route::get('/', function() {
        return redirect()->route('dashboard');
    });

    Route::prefix('auth')->group(function () {
        Route::prefix('login')->group(function () {
            Route::get('/', [AuthController::class, 'login'])->name('login');
            Route::post('/', [AuthController::class, 'doLogin'])->name('login');
        });

        Route::prefix('forgot-password')->group(function () {
            Route::get('/', [AuthController::class, 'forgotPassword'])->name('auth-forgot-password');
            Route::post('/', [AuthController::class, 'changePassword'])->name('auth-forgot-password');
        });

        Route::get('/logout', [AuthController::class, 'doLogout'])->name('logout');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('permissionIsValid:view');
    Route::get('/users', [DashboardController::class, 'index'])->name('users')->middleware('permissionIsValid:view');
    Route::get('/statuses', [DashboardController::class, 'index'])->name('statuses')->middleware('permissionIsValid:view');
    Route::get('/roles', [DashboardController::class, 'index'])->name('roles')->middleware('permissionIsValid:view');
    Route::get('/menus', [DashboardController::class, 'index'])->name('menus')->middleware('permissionIsValid:view');
    Route::get('/permissions', [DashboardController::class, 'index'])->name('permissions')->middleware('permissionIsValid:view');
    Route::get('/roles-menus-permissions', [DashboardController::class, 'index'])->name('roles-menus-permissions')->middleware('permissionIsValid:view');
    Route::get('/users-roles', [DashboardController::class, 'index'])->name('users-roles')->middleware('permissionIsValid:view');

});
