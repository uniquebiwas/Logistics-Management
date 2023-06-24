<?php

use App\Http\Controllers\Integration\AustralianController;
use Illuminate\Support\Facades\Route;

Route::get('/order-list', [AustralianController::class, 'index'])->name('order-list');
Route::post('/create-order', [AustralianController::class, 'store'])->name('order-store');
Route::delete('/single-order/{id}', [AustralianController::class, 'deletePool'])->name('order-delete');
Route::get('/order-status/{id}', [AustralianController::class, 'checkStatus'])->name('order-status');
Route::get('/get-label/{id}', [AustralianController::class, 'getLabel'])->name('order-get-label');
Route::post('/allocation/{id}', [AustralianController::class, 'quickAllocation'])->name('order-quickAllocation');
