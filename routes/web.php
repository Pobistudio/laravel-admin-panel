<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
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

    Route::prefix('users')->group(function () {

        Route::get('/', [UserController::class, 'index'])->name('users')->middleware('permissionIsValid:view');

        Route::post('/', [UserController::class, 'index'])->name('users')->middleware('permissionIsValid:view');

        Route::prefix('create')->group(function () {
            Route::get('/', [UserController::class, 'create'])->name('users-create')->middleware('permissionIsValid:view');
            Route::post('/', [UserController::class, 'store'])->name('users-create')->middleware('permissionIsValid:create');
        });

        Route::prefix('edit')->group(function () {
            Route::get('{id}', [UserController::class, 'edit'])->name('users-edit')->middleware('permissionIsValid:view');
            Route::post('{id}', [UserController::class, 'update'])->name('users-edit')->middleware('permissionIsValid:update');
        });

        Route::get('/reset-password/{id}', [UserController::class, 'resetPassword'])->name('users-reset-password')->middleware('permissionIsValid:reset_password');

        Route::prefix('change-status')->group(function () {
            Route::get('/{id}', [UserController::class, 'changeStatus'])->name('users-change-status')->middleware('permissionIsValid:change_status');
            Route::post('/{id}', [UserController::class, 'doChangeStatus'])->name('users-change-status')->middleware('permissionIsValid:change_status');
        });

        Route::prefix('change-role')->group(function () {
            Route::get('/{id}', [UserController::class, 'changeRole'])->name('users-change-role')->middleware('permissionIsValid:change_role');
            Route::post('/{id}', [UserController::class, 'doChangeRole'])->name('users-change-role')->middleware('permissionIsValid:change_role');
        });
    });
    Route::prefix('settings')->group(function () {
        Route::get('/statuses', [DashboardController::class, 'index'])->name('statuses')->middleware('permissionIsValid:view');
        Route::get('/roles', [DashboardController::class, 'index'])->name('roles')->middleware('permissionIsValid:view');
        Route::get('/menus', [DashboardController::class, 'index'])->name('menus')->middleware('permissionIsValid:view');
        Route::get('/permissions', [DashboardController::class, 'index'])->name('permissions')->middleware('permissionIsValid:view');
        Route::prefix('mapping')->group(function () {
            Route::get('/roles-menus-permissions', [DashboardController::class, 'index'])->name('roles-menus-permissions')->middleware('permissionIsValid:view');
            Route::get('/users-roles', [DashboardController::class, 'index'])->name('users-roles')->middleware('permissionIsValid:view');
        });
    });

});
