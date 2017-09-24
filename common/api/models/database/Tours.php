<?php
namespace common\api\models\database;

use yii\db\ActiveRecord;

/**
 * Class Tours
 *
 * @package api\models\database
 *
 * @property integer $id
 * @property string $title_us
 * @property string $title_ge
 * @property string $title_ru
 * @property string $text_us
 * @property string $text_ge
 * @property string $text_ru
 * @property string $image
 */
class Tours extends ActiveRecord {

    public static function tableName() {
        return 'tours';
    }

}