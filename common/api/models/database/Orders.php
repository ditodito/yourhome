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

}