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
    ];

    protected $casts = [
        'title' => 'array',
        'description' => 'array',
    ];

    protected static array $translatedAttributes = [
        'title',
        'description',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(ImageEnum::IMAGE)->singleFile();
    }

    public function image()
    {
        return MediaHelper::mediaRelationship($this, 'image');
    }
}
