<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;

class MediaHelper
{
    public static function mediaRelationship(Model $model, string $collectionName = 'default', array $additionalSelectedColumns = [])
    {
        return $model
            ->media()
            ->where('collection_name', $collectionName)
            ->select(
                array_merge(
                    ['id', 'model_id', 'disk', 'file_name', 'mime_type'],
                    $additionalSelectedColumns
                )
            );
    }


    public static function uploadMedia($model, $file, $collection)
    {
        if (!$file) {
            return;
        }

        $media = $model->addMedia($file)
            ->toMediaCollection($collection, 'media');

        $filePath = $media->getPath();

        if (file_exists($filePath)) {
            // اجبار الملف ليكون قابل للقراءة والتنفيذ
            @chmod($filePath, 0644); // أو 0755 لو فعلاً لازم
        }
    }
}
