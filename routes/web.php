<?php

use App\Http\Controllers\Web\AdminController;
use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Admin\Banner\AdminBannerController;
use App\Http\Controllers\Web\Admin\Advertisement\AdminAdvertisementController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;



Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Route::get('/', function () {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('admin.login');
    });

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth:admin');

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/tables', [AdminController::class, 'tables'])->name('admin.tables');
        Route::get('/billing', [AdminController::class, 'billing'])->name('admin.billing');
        Route::get('/virtual-reality', [AdminController::class, 'virtualReality'])->name('admin.virtual-reality');
        Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');



        Route::prefix('banners')->name('banners.')->group(function () {
            Route::get('/', [AdminBannerController::class, 'index'])->name('index');
            Route::get('/create', [AdminBannerController::class, 'create'])->name('create');
            Route::post('/', [AdminBannerController::class, 'store'])->name('store');
            Route::get('/{banner}/edit', [AdminBannerController::class, 'edit'])->name('edit');
            Route::put('/{banner}', [AdminBannerController::class, 'update'])->name('update');
            Route::delete('/{banner}', [AdminBannerController::class, 'destroy'])->name('destroy');
        });
        Route::prefix('advertisements')->name('advertisements.')->group(function () {
            Route::get('/', [AdminAdvertisementController::class, 'index'])->name('index');

            Route::get('/create', [AdminAdvertisementController::class, 'create'])->name('create');
            Route::post('/', [AdminAdvertisementController::class, 'store'])->name('store');
            Route::delete('/{advertisement}', [AdminAdvertisementController::class, 'destroy'])->name('destroy');
        });
    });

    // يمكنك إضافة المزيد من الصفحات هنا حسب الحاجة
});
