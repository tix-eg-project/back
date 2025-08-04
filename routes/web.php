<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AdminController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
    // صفحة الـ Dashboard
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // صفحة الـ Tables
    Route::get('/tables', [AdminController::class, 'tables'])->name('admin.tables');

    // صفحة الـ Billing
    Route::get('/billing', [AdminController::class, 'billing'])->name('admin.billing');

    // صفحة الـ Virtual Reality
    Route::get('/virtual-reality', [AdminController::class, 'virtualReality'])->name('admin.virtual-reality');

    // صفحة الـ Profile
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');

    // يمكنك إضافة المزيد من الصفحات هنا حسب الحاجة
});
