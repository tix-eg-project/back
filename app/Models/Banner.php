<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use App\Enums\ImageEnum;
use App\Helpers\MediaHelper;
use App\Traits\HasTranslatedName;

class Banner extends Model implements HasMedia
{
    use InteractsWithMedia, HasTranslatedName;

    protected $fillable = [
        'title',
        'description',
        'image',
    ];

    protected $casts = [
        'title' => 'array',
        'description' => 'array',
    ];

    protected static array $translatedAttributes = [
        'title',
        'description',
    ];

    public function getTitleAttribute($value)
    {
        $locale = app()->getLocale();
        $decodedValue = json_decode($value, true);

        return is_array($decodedValue) ? $decodedValue[$locale] ?? $decodedValue['en'] : $decodedValue;
    }

    public function getDescriptionAttribute($value)
    {
        $locale = app()->getLocale();
        $decodedValue = json_decode($value, true);

        return is_array($decodedValue) ? $decodedValue[$locale] ?? $decodedValue['en'] : $decodedValue;
    }
}
