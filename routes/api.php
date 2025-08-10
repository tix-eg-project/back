<?php

use App\Http\Controllers\Api\Auth\User\UserAuthController;
use App\Http\Controllers\Api\Auth\Vendor\RegisterVendorController;
use App\Http\Controllers\Api\Country\Cities\CityController;
use App\Http\Controllers\Api\Country\CountryController;
use App\Http\Controllers\Api\User\Advertisement\AdvertisementController;
use App\Http\Controllers\Api\User\Banner\BannerController;
use App\Http\Controllers\Api\User\Category\CategoryController;
use App\Http\Controllers\Api\User\Subcategory\SubcategoryController;
use App\Models\Advertisement;
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

Route::middleware('locale')  // الآن بدون auth:sanctum
    ->group(function () {
        Route::get('banners',                       [BannerController::class, 'index']);
        Route::get('advertisements',                       [AdvertisementController::class, 'index']);
        Route::get('categories',                       [CategoryController::class, 'index']);
        Route::get('subcategories',                       [SubcategoryController::class, 'index']);

        Route::get('countries',                       [CountryController::class, 'index']);
        Route::get('cities/{country_id}', [CityController::class, 'index']);

        Route::post('vendor/register', [RegisterVendorController::class, 'register']);
    });
