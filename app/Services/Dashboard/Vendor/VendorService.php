<?php

namespace App\Services\Dashboard\Vendor;

use App\Helpers\ImageManger;
use App\Models\Admin;
use App\Models\User;
use App\Models\Vendor;
use App\Notifications\DashboardNotification;
use Illuminate\Support\Facades\Hash;

class VendorService
{
    protected $imageManger;

    public function __construct(ImageManger $imageManger)
    {
        $this->imageManger = $imageManger;
    }

    /**
     * Create a new vendor.
     *
     * @param array $data
     * @return Vendor
     */
    public function store(array $data): Vendor
    {

        $data['password'] = Hash::make($data['password']);

        // إنشاء البائع
        $vendor = Vendor::create([
            'company_name'  => $data['company_name'],
            'description'   => $data['description'],
            'name'          => $data['name'],
            'email'         => $data['email'],
            'phone'         => $data['phone'],
            'password'      => $data['password'],
            'address'       => $data['address'],
            'Postal_code'   => $data['Postal_code'],
            'vodafone-cash' => $data['vodafone-cash'],
            'instapay'      => $data['instapay'],
            'Type_business' => $data['Type_business'],
            'category_id'   => $data['category_id'],
            'country_id'    => $data['country_id'],
            'city_id'       => $data['city_id'],
        ]);
        // إرسال إشعار إلى الأدمن
        $admins = Admin::all();
        foreach ($admins as $admin) {
            \Log::info('Sending notification to admin ID: ' . $admin->id);
            $admin->notify(new DashboardNotification('تم تسجيل بائع جديد: ' . $vendor->name . ' - ' . $vendor->email));
        }


        return $vendor;
    }
    /**
     * Update an existing vendor.
     *
     * @param Vendor $vendor
     * @param array $data
     * @return Vendor
     */
    public function update(Vendor $vendor, array $data): Vendor
    {
        // Check if an image is provided, upload it and update the image field
        if (isset($data['image'])) {
            $data['image'] = $this->imageManger->uploadImage('vendors', $data['image']);
        }

        // Hashing the password if provided
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        // Update the vendor record
        $vendor->update([
            'company_name'  => $data['company_name'] ?? $vendor->company_name,
            'description'   => $data['description'] ?? $vendor->description,
            'name'          => $data['name'] ?? $vendor->name,
            'email'         => $data['email'] ?? $vendor->email,
            'phone'         => $data['phone'] ?? $vendor->phone,
            'password'      => $data['password'] ?? $vendor->password,
            'image'         => $data['image'] ?? $vendor->image,
            'address'       => $data['address'] ?? $vendor->address,
            'Postal_code'   => $data['Postal_code'] ?? $vendor->Postal_code,
            'vodafone-cash' => $data['vodafone-cash'] ?? $vendor->vodafone_cash,
            'instapay'      => $data['instapay'] ?? $vendor->instapay,
            'Type_business' => $data['Type_business'] ?? $vendor->Type_business,
            'category_id'   => $data['category_id'] ?? $vendor->category_id,
            'country_id'    => $data['country_id'] ?? $vendor->country_id,
            'city_id'       => $data['city_id'] ?? $vendor->city_id,
        ]);

        return $vendor;
    }

    /**
     * Get vendor by ID.
     *
     * @param int $id
     * @return Vendor
     */
    public function getById(int $id): Vendor
    {
        // Retrieve the vendor by ID
        return Vendor::findOrFail($id);
    }
}
