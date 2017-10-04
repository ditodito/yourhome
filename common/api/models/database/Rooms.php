<?php
namespace common\api\models\database;

use yii\db\ActiveRecord;

/**
 * Class Rooms
 *
 * @package api\models\database
 *
 * @property integer $id
 * @property string $name_us
 * @property string $name_ge
 * @property string $name_ru
 * @property string $description_us
 * @property string $description_ge
 * @property string $description_ru
 * @property string $image
 * @property int $capacity
 * @property int $price
 * @property int $free_wifi
 * @property int $tv
 * @property int $air_conditioning
 * @property int $shared_bathroom
 * @property int $private_bathroom
 * @property int $hairdrayer
 * @property int $heating
 * @property int $linen
 * @property int $shared_kitchenette
 * @property int $private_kitchenette
 * @property int $non_smoking
 * @property int $toiletries
 * @property int $towels
 * @property int $slippers
 */
class Rooms extends ActiveRecord {

    public static function tableName() {
        return 'rooms';
    }

}