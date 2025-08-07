<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = 'vendors';

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
        'city_id'
    ];

    protected $guarded = [];
}
