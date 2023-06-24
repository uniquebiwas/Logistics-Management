<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ShowUserController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::resource('users', UserController::class);
Route::get('userType', [ShowUserController::class, 'index'])->name('showUserType');
Route::resource('roles', RoleController::class);
