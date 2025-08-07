<?php

use App\Http\Controllers\Web\AdminProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Web\Admin\Advertisement\AdminAdvertisementController;
use App\Http\Controllers\Web\Admin\Banner\AdminBannerController;
use App\Http\Controllers\Web\Admin\Category\AdminCategoryController;
use App\Http\Controllers\Web\Admin\Subcategory\AdminSubcategoryController;
use App\Http\Controllers\Web\Admin\City\CityController;
use App\Http\Controllers\Web\Admin\Country\CountryController;
use App\Http\Controllers\Web\AdminController;
use App\Http\Controllers\Web\Auth\LoginController;
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
    Route::post('admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

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

        Route::prefix('categories')->name('categories.')->group(function () {
            Route::get('/', [AdminCategoryController::class, 'index'])->name('index');
            Route::get('/create', [AdminCategoryController::class, 'create'])->name('create');
            Route::post('/', [AdminCategoryController::class, 'store'])->name('store');
            Route::get('/{category}/edit', [AdminCategoryController::class, 'edit'])->name('edit');
            Route::put('/{category}', [AdminCategoryController::class, 'update'])->name('update');
            Route::delete('/{category}', [AdminCategoryController::class, 'destroy'])->name('destroy');
        });
        Route::prefix('subcategories')->name('subcategories.')->group(function () {
            Route::get('/', [AdminSubcategoryController::class, 'index'])->name('index');
            Route::get('/create', [AdminSubcategoryController::class, 'create'])->name('create');
            Route::post('/', [AdminSubcategoryController::class, 'store'])->name('store');
            Route::get('/{subcategory}/edit', [AdminSubcategoryController::class, 'edit'])->name('edit');
            Route::put('/{subcategory}', [AdminSubcategoryController::class, 'update'])->name('update');
            Route::delete('/{subcategory}', [AdminSubcategoryController::class, 'destroy'])->name('destroy');
        });
    });

    // يمكنك إضافة المزيد من الصفحات هنا حسب الحاجة

    Route::prefix('countries')->group(function () {
        Route::get('/', [CountryController::class, 'index'])->name('country.index');
        Route::get('/create', [CountryController::class, 'create'])->name('country.create');
        Route::post('/', [CountryController::class, 'store'])->name('country.store');
        Route::get('/{id}/edit', [CountryController::class, 'edit'])->name('country.edit');
        Route::put('/{id}', [CountryController::class, 'update'])->name('country.update');
        Route::delete('/{id}', [CountryController::class, 'destroy'])->name('country.destroy');
    });

    Route::prefix('cities')->group(function () {
        Route::get('/', [CityController::class, 'index'])->name('cities.index');
        Route::get('/create', [CityController::class, 'create'])->name('cities.create');
        Route::post('/', [CityController::class, 'store'])->name('cities.store');
        Route::get('/{id}/edit', [CityController::class, 'edit'])->name('cities.edit');
        Route::put('/{id}', [CityController::class, 'update'])->name('cities.update');
        Route::delete('/{id}', [CityController::class, 'destroy'])->name('cities.destroy');
    });

    Route::prefix('users')->group(function () {
        Route::get('profile', [AdminProfileController::class, 'profile'])->name('admin.profile');
        Route::post('/updateProfile', [AdminProfileController::class, 'updateProfile'])->name('admin.updateProfile');
    });
});
