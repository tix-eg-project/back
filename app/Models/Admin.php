<?php

namespace App\Models;

use App\Enums\ImageEnum;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class Admin extends Authenticatable implements HasMedia
{


    use  InteractsWithMedia, Notifiable;
    protected $guard = 'admin';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $guard_name = 'admin';

    public function getImageUrlAttribute(): ?string
    {
        return $this->getFirstMediaUrl(ImageEnum::IMAGE, 'media');
    }
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection(ImageEnum::IMAGE)
            ->singleFile();
    }
}
