<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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

            Route::get('/delete/{id}', [StatusController::class, 'delete'])->name('statuses-delete')->middleware('permissionIsValid:delete');

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

            Route::get('/delete/{id}', [RoleController::class, 'delete'])->name('roles-delete')->middleware('permissionIsValid:delete');

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

            Route::get('/delete/{id}', [PermissionController::class, 'delete'])->name('permissions-delete')->middleware('permissionIsValid:delete');

        });

        Route::get('/menus', [MenuController::class, 'index'])->name('menus')->middleware('permissionIsValid:view');

        Route::get('/xx', [DashboardController::class, 'index'])->name('menus')->middleware('permissionIsValid:view');Route::prefix('mapping')->group(function () {
            Route::get('/roles-menus-permissions', [DashboardController::class, 'index'])->name('roles-menus-permissions')->middleware('permissionIsValid:view');
            Route::get('/users-roles', [DashboardController::class, 'index'])->name('users-roles')->middleware('permissionIsValid:view');
        });
    });

});
