<?php

namespace App\Services\Dashboard;

use App\Models\Vendor;
use App\Notifications\DashboardNotification;
use Illuminate\Http\Request;

class VendoreService
{
    public function index()
    {
        $search = request('search');
        $query = Vendor::query();
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }
        return $query->latest()->paginate(10);
    }

    public function destroy($id)
    {
        Vendor::query()->findOrFail($id)->delete();
    }

    public function show($id)
    {
        return Vendor::query()->findOrFail($id);
    }

    public function updateStatus($status, Vendor $vendor)
    {
        $vendor->update([
            'status' => $status
        ]);

        $statusMessage = $status == 1
            ? 'تمت الموافقة على الاشتراك من قبل الإدارة'
            : 'تم رفض الاشتراك من قبل الإدارة';

        $user = $vendor->user;
        if ($user) {
            $user->notify(new DashboardNotification($statusMessage));
        }

        return true;
    }
}
