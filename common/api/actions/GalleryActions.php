<?php
namespace common\api\actions;

use common\api\models\database\Gallery;
use common\api\models\response\GalleryRow;

class GalleryActions {

    public static function getGalleryImages() {
        $rows = Gallery::find()->all();
        $result = [];
        foreach($rows as $row) {
            $result[] = new GalleryRow($row);
        }
        return $result;
    }

}