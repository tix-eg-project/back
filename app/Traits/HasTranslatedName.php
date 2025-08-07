<?php

namespace App\Traits;

use Illuminate\Support\Facades\App;

trait HasTranslatedName
{
    /**
     * Accessor for the 'name' attribute.
     * Supports either:
     *  - JSON column cast to array, e.g. ['ar'=>..., 'en'=>...]
     *  - Separate columns name_ar, name_en
     */
    public function getNameAttribute($value)
    {
        $locale = app()->getLocale();  // الحصول على اللغة الحالية
        $decodedValue = json_decode($value, true);  // فك تشفير الـ JSON إذا كان الحقل مخزنًا كـ JSON

        // التحقق إذا كانت القيمة عبارة عن مصفوفة (أي JSON)
        return is_array($decodedValue) ? $decodedValue[$locale] ?? $decodedValue['en'] : $decodedValue;
    }


    /**
     * Accessor for the 'description' attribute.
     * Supports JSON stored descriptions similar to name attribute.
     */
    public function getDescriptionAttribute($value)
    {
        $locale = app()->getLocale(); // الحصول على اللغة الحالية
        $decodedValue = json_decode($value, true); // فك تشفير الـ JSON إذا كان الحقل مخزنًا كـ JSON

        // التحقق إذا كانت القيمة عبارة عن مصفوفة (أي JSON)
        return is_array($decodedValue) ? $decodedValue[$locale] ?? $decodedValue['en'] : $value;
    }
    public function getTitleAttribute()
    {
        $locale = app()->getLocale();
        $fallback = config('app.fallback_locale');

        $key = 'title_' . $locale;
        if (isset($this->$key)) {
            return $this->$key;
        }

        return $this->title_ar ?? null;
    }
    public function getJobTitleAttribute()
    {
        $locale = app()->getLocale();
        $fallback = config('app.fallback_locale');

        $key = 'job_title_' . $locale;
        return $this->$key ?? $this->{'job_title_' . $fallback} ?? null;
    }
    public function getAddressAttribute()
    {
        $locale = app()->getLocale();
        return $this->{"address_{$locale}"} ?? $this->address_ar;
    }

    public function getWorkHoursAttribute()
    {
        $locale = app()->getLocale();
        return $this->{"work_hours_{$locale}"} ?? $this->work_hours_ar;
    }
    public function getContentAttribute()
    {
        $locale = app()->getLocale();
        $fallback = config('app.fallback_locale');

        $key = 'content_' . $locale;
        return $this->$key ?? $this->{'content_' . $fallback} ?? null;
    }

    public function getTranslation(string $field, string $locale): ?string
    {
        return $this->{$field}[$locale] ?? null;
    }
}
