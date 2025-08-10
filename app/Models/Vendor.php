<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Vendor extends Authenticatable
{
    use Notifiable, HasApiTokens;

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
