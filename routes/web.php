<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IconController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StatusController;
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

        Route::prefix('icons')->group(function () {

            Route::get('/', [IconController::class, 'index'])->name('icons')->middleware('permissionIsValid:view');

            Route::prefix('create')->group(function () {
                Route::get('/', [IconController::class, 'create'])->name('icons-create')->middleware('permissionIsValid:view');
                Route::post('/', [IconController::class, 'store'])->name('icons-create')->middleware('permissionIsValid:create');
            });

            Route::prefix('edit')->group(function () {
                Route::get('{id}', [IconController::class, 'edit'])->name('icons-edit')->middleware('permissionIsValid:view');
                Route::post('{id}', [IconController::class, 'update'])->name('icons-edit')->middleware('permissionIsValid:update');
            });

        });

        Route::prefix('statuses')->group(function () {

            Route::get('/', [StatusController::class, 'index'])->name('statuses')->middleware('permissionIsValid:view');

            Route::prefix('create')->group(function () {
                Route::get('/', [StatusController::class, 'create'])->name('statuses-create')->middleware('permissionIsValid:view');
                Route::post('/', [StatusController::class, 'store'])->name('statuses-create')->middleware('permissionIsValid:create');
            });

            Route::prefix('edit')->group(function () {
                Route::get('{id}', [StatusController::class, 'edit'])->name('statuses-edit')->middleware('permissionIsValid:view');
                Route::post('{id}', [StatusController::class, 'update'])->name('statuses-edit')->middleware('permissionIsValid:update');
            });

            Route::get('/change-status/{id}/{status}', [StatusController::class, 'changeStatus'])->name('statuses-change-status')->middleware('permissionIsValid:change_status');

        });

        Route::prefix('roles')->group(function () {

            Route::get('/', [RoleController::class, 'index'])->name('roles')->middleware('permissionIsValid:view');

            Route::prefix('create')->group(function () {
                Route::get('/', [RoleController::class, 'create'])->name('roles-create')->middleware('permissionIsValid:view');
                Route::post('/', [RoleController::class, 'store'])->name('roles-create')->middleware('permissionIsValid:create');
            });

            Route::prefix('edit')->group(function () {
                Route::get('{id}', [RoleController::class, 'edit'])->name('roles-edit')->middleware('permissionIsValid:view');
                Route::post('{id}', [RoleController::class, 'update'])->name('roles-edit')->middleware('permissionIsValid:update');
            });

            Route::get('/change-status/{id}/{status}', [RoleController::class, 'changeStatus'])->name('roles-change-status')->middleware('permissionIsValid:change_status');

        });

        Route::prefix('permissions')->group(function () {

            Route::get('/', [PermissionController::class, 'index'])->name('permissions')->middleware('permissionIsValid:view');

            Route::prefix('create')->group(function () {
                Route::get('/', [PermissionController::class, 'create'])->name('permissions-create')->middleware('permissionIsValid:view');
                Route::post('/', [PermissionController::class, 'store'])->name('permissions-create')->middleware('permissionIsValid:create');
            });

            Route::prefix('edit')->group(function () {
                Route::get('{id}', [PermissionController::class, 'edit'])->name('permissions-edit')->middleware('permissionIsValid:view');
                Route::post('{id}', [PermissionController::class, 'update'])->name('permissions-edit')->middleware('permissionIsValid:update');
            });

            Route::get('/change-status/{id}/{status}', [PermissionController::class, 'changeStatus'])->name('permissions-change-status')->middleware('permissionIsValid:change_status');

        });

        Route::prefix('menus')->group(function () {

            Route::get('/', [MenuController::class, 'index'])->name('menus')->middleware('permissionIsValid:view');

            Route::prefix('create')->group(function () {
                Route::get('/', [MenuController::class, 'create'])->name('menus-create')->middleware('permissionIsValid:view');
                Route::post('/', [MenuController::class, 'store'])->name('menus-create')->middleware('permissionIsValid:create');
            });

            Route::prefix('edit')->group(function () {
                Route::get('{id}', [MenuController::class, 'edit'])->name('menus-edit')->middleware('permissionIsValid:view');
                Route::post('{id}', [MenuController::class, 'update'])->name('menus-edit')->middleware('permissionIsValid:update');
            });

            Route::get('/change-status/{id}/{status}', [MenuController::class, 'changeStatus'])->name('menus-change-status')->middleware('permissionIsValid:change_status');

        });

    });

});
