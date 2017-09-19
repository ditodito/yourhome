<?php
namespace common\api\actions;

use yii\helpers\FileHelper;

class GalleryActions {

    public static function getGalleryImages() {
        $images = [];
        $dir_images = FileHelper::findFiles('../../frontend/web/img/gallery');
        foreach($dir_images as $image) {
            $images[] = basename($image);
        }
        return $images;
    }

}