<?php

namespace App\Repositories;

use App\Models\Banner;
use App\Helpers\MediaHelper;
use App\Enums\ImageEnum;

class BannerRepository
{
    public function create(array $data): Banner
    {
        $banner = Banner::create([
            'title' => $data['title'],
            'description' => $data['description'],
        ]);

        // تحميل الصورة بعد إنشاء الـ Banner
        $this->uploadImage($banner, $data['image'] ?? null);

        return $banner;
    }

    public function update(Banner $banner, array $data): Banner
    {
        $banner->update([
            'title' => $data['title'],
            'description' => $data['description'],
        ]);

        // تحميل الصورة بعد تحديث الـ Banner
        if (!empty($data['image'])) {
            $this->uploadImage($banner, $data['image']);
        }

        return $banner;
    }

    public function delete(Banner $banner): bool
    {
        $banner->clearMediaCollection(ImageEnum::IMAGE);
        return $banner->delete();
    }

    private function uploadImage(Banner $banner, $image)
    {
        if ($image) {
            MediaHelper::uploadMedia(
                $banner,
                $image,
                ImageEnum::IMAGE,
                'media'
            );
        }
    }
}
