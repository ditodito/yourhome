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
 * @property integer $quantity
 * @property integer $capacity
 * @property integer $is_hostel
 * @property integer $price
 * @property integer $free_wifi
 * @property integer $tv
 * @property integer $air_conditioning
 * @property integer $shared_bathroom
 * @property integer $private_bathroom
 * @property integer $hairdrayer
 * @property integer $heating
 * @property integer $linen
 * @property integer $shared_kitchenette
 * @property integer $private_kitchenette
 * @property integer $non_smoking
 * @property integer $toiletries
 * @property integer $towels
 * @property integer $slippers
 */
class Rooms extends ActiveRecord {

    public static function tableName() {
        return 'rooms';
    }

    public function getOrders() {
        return $this->hasMany(Orders::className(), ['room_id' => 'id']);
    }

}