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
        $locale = App::getLocale();
        $fallback = config('app.fallback_locale');

        // 1) إذا كان مُخزّن كـ JSON ومُعرّف في casts
        if (is_array($value)) {
            return $value[$locale]
                ?? $value[$fallback]
                ?? null;
        }

        // 2) إذا كان مُخزّن في عمودين منفصلين
        $key = 'name_' . $locale;
        if (isset($this->$key)) {
            return $this->$key;
        }

        return $this->name_ar ?? null;
    }

    /**
     * Accessor for the 'description' attribute.
     * Supports both JSON array or separate description_ar/description_en.
     */
    public function getDescriptionAttribute($value)
    {
        $locale = App::getLocale();
        $fallback = config('app.fallback_locale');

        if (is_array($value)) {
            return $value[$locale]
                ?? $value[$fallback]
                ?? null;
        }

        $key = 'description_' . $locale;
        if (isset($this->$key)) {
            return $this->$key;
        }

        return $this->description_ar ?? null;
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
}
