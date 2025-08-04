<?php

use App\Http\Controllers\Web\AdminController;
use App\Http\Controllers\Web\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    // صفحة الـ Dashboard (التوجيه إلى Login إذا لم يكن مسجل)
    Route::get('/', function () {
        // إذا كان المستخدم مسجلًا كـ Admin
        if (Auth::guard('admin')->check()) {
            // إذا كان مسجلًا، يذهب مباشرة إلى الـ Dashboard
            return redirect()->route('admin.dashboard');
        }

        // إذا لم يكن مسجلًا، يذهب إلى صفحة الـ Login
        return redirect()->route('admin.login');
    });

    // صفحة الـ Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth:admin');

    // صفحة الـ Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'login']);

    // إذا كنت تستخدم الحماية عبر الـ Middleware للتوثيق، يمكن إضافة ذلك للمسارات التي تحتاج للتحقق من التوثيق
    Route::middleware(['auth:admin'])->group(function () {
        // باقي الصفحات التي تحتاج التوثيق
        Route::get('/tables', [AdminController::class, 'tables'])->name('admin.tables');
        Route::get('/billing', [AdminController::class, 'billing'])->name('admin.billing');
        Route::get('/virtual-reality', [AdminController::class, 'virtualReality'])->name('admin.virtual-reality');
        Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    });

    // يمكنك إضافة المزيد من الصفحات هنا حسب الحاجة
});
