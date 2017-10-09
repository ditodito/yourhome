<?php
namespace common\api\models\database;

use yii\db\ActiveRecord;

/**
 * Class Rooms
 *
 * @package api\models\database
 *
 * @property integer $id
 * @property integer $room_id
 * @property integer $capacity
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property integer $country_id
 * @property string $city
 * @property string $address
 * @property string $zip_code
 * @property string $mobile
 * @property string $comment
 * @property mixed $arrival_time
 * @property mixed $start_date
 * @property mixed $end_date
 * @property integer $status
 * @property integer $description_ru
 * @property integer $image
 */
class Orders extends ActiveRecord {

    public static function tableName() {
        return 'orders';
    }

    public function getRoom() {
        return $this->hasOne(Rooms::className(), ['id' => 'room_id']);
    }

    public function getCountry() {
        return $this->hasOne(Countries::className(), ['id' => 'country_id']);
    }

}