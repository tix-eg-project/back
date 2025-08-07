<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // دالة لعرض صفحة الـ Dashboard
    public function dashboard()
    {
        $citycount = City::count();
        $countrycount = Country::count();
        return view('Admin.dashboard', compact('citycount', 'countrycount'));
    }

    // دالة لعرض صفحة الـ Tables
    public function tables()
    {
        return view('Admin.pages.tables');
    }

    // دالة لعرض صفحة الـ Billing
    public function billing()
    {
        return view('Admin.pages.billing');
    }

    // دالة لعرض صفحة الـ Virtual Reality
    public function virtualReality()
    {
        return view('Admin.pages.virtual-reality');
    }

    // دالة لعرض صفحة الـ Profile
    public function profile()
    {
        return view('Admin.pages.profile');
    }

    // يمكنك إضافة المزيد من الدوال هنا للصفحات الأخرى
}
