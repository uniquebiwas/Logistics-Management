<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\PasswordController;
use App\Http\Controllers\Api\Auth\SanctumController;
use App\Http\Controllers\Api\NotificationListController;
use App\Http\Controllers\Api\RemoveNotificationController;
use App\Http\Controllers\Api\SignUpOtpController;
use App\Http\Controllers\Api\UserGeoLocationController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('/login', [SanctumController::class, 'login']);
    Route::post('/logout', [SanctumController::class, 'logout'])->middleware(['auth:sanctum']);

    // Route::post('/customer/request-otp', [AuthController::class, 'customerToken']);
    // Route::post('/customer/verify-otp', [AuthController::class, 'customerLogin']);
    // Route::post('user/login', [AuthController::class, 'login']);
    // Route::post('/user/sign-up', [AuthController::class, 'signup']);
    // Route::post('/user/sign-up/otp', [SignUpOtpController::class, 'sendOtp']);
    // Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'user'],  function ($router) {
    //     Route::post('/change-password', [PasswordController::class, 'changePassword']);
    //     Route::post('/logout', [AuthController::class, 'logout']);
    //     Route::post('/update-geo-location', [UserGeoLocationController::class, 'updateGioLocation']);
    //     Route::post('/notifications', [NotificationListController::class, 'allNotifications']);
    //     $router->post('/remove-notification/{notificationId}', RemoveNotificationController::class);
    // });


    // Route::post('/forgot-password', [PasswordController::class, 'forgotPassword']);
    // Route::post('/reset-password', [PasswordController::class, 'resetPassword']);
});
