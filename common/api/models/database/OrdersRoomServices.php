<?php
namespace common\api\models\database;

use yii\db\ActiveRecord;

/**
 * Class Orders Room Services
 *
 * @package api\models\database
 *
 * @property integer $order_room_id
 * @property integer $room_service_id
 * @property integer $price
 * @property integer $per_night
 */
class OrdersRoomServices extends ActiveRecord {

    public static function tableName() {
        return 'orders_room_services';
    }

    public function getOrderRoom() {
        return $this->hasOne(OrdersRoom::className(), ['id' => 'order_room_id']);
    }

    public function getRoomService() {
        return $this->hasOne(RoomsServices::className(), ['id' => 'room_service_id']);
    }

}