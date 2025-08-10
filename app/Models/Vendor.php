<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Vendor as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Vendor extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'company_name',
        'description',
        'name',
        'email',
        'phone',
        'password',
        'image',
        'address',
        'Postal_code',
        'vodafone-cash',
        'instapay',
        'Type_business',
        'category_id',
        'country_id',
        'city_id',
        'status',
    ];
    protected $casts = [
        'data' => 'array',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $guard_name = 'vendor';
}
