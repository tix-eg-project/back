<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Vendor extends Authenticatable
{
    use Notifiable;
    protected $table = 'vendors';
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

    protected $guarded = [];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    // في موديل Vendor
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $casts = [
        'data' => 'array',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $guard_name = 'vendor';
}
