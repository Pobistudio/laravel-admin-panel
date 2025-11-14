<?php

use App\Http\Controllers\Api\AssignMenuPermissionController;
use App\Http\Middleware\EnsureSessionIsValid;
use Illuminate\Support\Facades\Route;

Route::get('/menu-permissions/{roleId}', [AssignMenuPermissionController::class, 'getMenuPermissionsByRole'])
     ->name(name: 'menu-permissions-by-role');
