<?php
namespace common\api\models\database;

use yii\db\ActiveRecord;

/**
 * Class Tours
 *
 * @package api\models\database
 *
 * @property integer $id
 * @property string $title_en-US
 * @property string $title_ka-GE
 * @property string $title_ru-RU
 * @property string $text_en-US
 * @property string $text_ka-GE
 * @property string $text_ru-RU
 * @property string $image
 */
class Tours extends ActiveRecord {

    public static function tableName() {
        return 'tours';
    }

}