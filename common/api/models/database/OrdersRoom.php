<?php
namespace common\api\models\database;

use yii\db\ActiveRecord;

/**
 * Class Rooms
 *
 * @package api\models\database
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $room_id
 * @property integer $extra_bed
 */
class OrdersRoom extends ActiveRecord {

    public static function tableName() {
        return 'orders_room';
    }

    public function getOrder() {
        return $this->hasOne(Orders::className(), ['id' => 'order_id']);
    }

    public function getRoom() {
        return $this->hasOne(Rooms::className(), ['id' => 'room_id']);
    }

}