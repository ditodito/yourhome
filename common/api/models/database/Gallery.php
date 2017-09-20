<?php
namespace common\api\models\database;

use yii\db\ActiveRecord;

/**
 * Class Gallery
 *
 * @package api\models\database
 *
 * @property integer $id
 * @property string $image_name
 * @property string $image_name_thumb
 * @property string $description
  */
class Gallery extends ActiveRecord {

    public static function tableName() {
        return 'gallery';
    }

}