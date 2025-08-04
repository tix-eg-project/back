<?php

use App\Http\Controllers\Api\Auth\User\UserAuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth/user')->group(function () {
    Route::post('register',            [UserAuthController::class, 'register']);
    Route::post('verify',              [UserAuthController::class, 'verify']);
    Route::post('login',               [UserAuthController::class, 'login']);
    Route::post('send-reset-code',     [UserAuthController::class, 'sendResetCode']);
    Route::post('forget-password',     [UserAuthController::class, 'forgetPassword']);
    Route::post('verify-reset-code',   [UserAuthController::class, 'verifyResetCode']);
    Route::post('reset-password',      [UserAuthController::class, 'resetPassword']);
});
