<?php

namespace App\Http\Controllers\Web\Vendor;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    // دالة لعرض صفحة الـ Dashboard
    public function dashboard()
    {

        return view('Vendor.dashboard');
    }

    // دالة لعرض صفحة الـ Tables
    public function tables()
    {
        return view('Vendor.pages.tables');
    }

    // دالة لعرض صفحة الـ Billing
    public function billing()
    {
        return view('Vendor.pages.billing');
    }

    // دالة لعرض صفحة الـ Virtual Reality
    public function virtualReality()
    {
        return view('Vendor.pages.virtual-reality');
    }

    // دالة لعرض صفحة الـ Profile
    // public function profile()
    // {
    //     return view('Vendor.pages.profile');
    // }

    // يمكنك إضافة المزيد من الدوال هنا للصفحات الأخرى
}
