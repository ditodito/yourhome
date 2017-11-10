<?php
namespace common\api\actions;

use common\api\models\database\AirportTransferPrices;
use common\api\models\database\Orders;
use common\api\models\database\OrdersRoom;
use common\api\models\database\OrdersRoomServices;
use common\api\models\response\IdNamePair;
use yii\base\Exception;

class OrderActions {

    public static function getAirportTransferPrices() {
        $rows = AirportTransferPrices::find()->all();
        $result = [];

        foreach($rows as $row) {
            $result[] = new IdNamePair($row['id'], $row['persons'].'p - '.$row['price'].' GEL');
        }

        return $result;
    }

    public static function removeOrder($id, $order_key) {
        $order = Orders::findOne(['id' => $id, 'order_key' => $order_key]);
        if (!$order)
            return false;

        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $order->delete();

            foreach(OrdersRoom::findAll(['order_id' => $order->id]) as $order_room) {
                $order_room->delete();

                foreach(OrdersRoomServices::findAll(['order_room_id' => $order_room->id]) as $order_room_service) {
                    $order_room_service->delete();
                }

            }

            $transaction->commit();
            return true;
        } catch(Exception $ex) {
            $transaction->rollBack();
            \Yii::error('Remove order: '.$ex->getMessage().' '.$ex->getLine());
        }

        return false;
    }

    public static function removeOrderRoom($id, $order_key) {
        $order_room = OrdersRoom::findOne(['id' => $id]);
        if (!$order_room)
            return false;

        $order = Orders::findOne(['id' => $order_room->order_id, 'order_key' => $order_key]);
        if (!$order)
            return false;

        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $order_room->delete();
            OrdersRoomServices::deleteAll(['order_room_id' => $order_room->id]);

            if (count($order->ordersRoom) == 0)
                $order->delete();

            $transaction->commit();
            return true;
        } catch(Exception $ex) {
            $transaction->rollBack();
            \Yii::error('Remove order room: '.$ex->getMessage().' '.$ex->getLine());
        }

        return false;
    }

}