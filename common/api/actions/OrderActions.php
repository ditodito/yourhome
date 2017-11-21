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
        $order = Orders::findOne(['id' => $id, 'order_key' => $order_key, 'status' => 1]);
        if (!$order)
            return false;

        $time = time();

        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $order->canceled = $time;
            $order->status = 2;
            $order->save();

            foreach(OrdersRoom::findAll(['order_id' => $order->id]) as $order_room) {
                $order_room->canceled = $time;
                $order_room->status = 2;
                $order_room->save();
            }

            $mail = \Yii::$app->mailer->compose(['html' => 'orderCancelConfirmation-html'/*, 'text' => 'orderCancelConfirmation-text'*/], [
                'order' => $order
            ])->setFrom(\Yii::$app->params['infoEmail'])
                ->setTo($order->email)
                ->setSubject(\Yii::t('order', 'Cancellation details').'. '.\Yii::t('main', 'Hotel').' YOUR HOME');

            if (!$mail->send())
                throw new Exception('Order cancel confirm email was not send');

            $transaction->commit();
            return $order->id;
        } catch(Exception $ex) {
            $transaction->rollBack();
            \Yii::error('Remove order: '.$ex->getMessage().' '.$ex->getLine());
        }

        return false;
    }

    public static function removeOrderRoom($id, $order_key) {
        $order_room = OrdersRoom::findOne(['id' => $id, 'status' => 1]);
        if (!$order_room)
            return false;

        $order = Orders::findOne(['id' => $order_room->order_id, 'order_key' => $order_key]);
        if (!$order)
            return false;

        $time = time();

        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $order_room->canceled = $time;
            $order_room->status = 2;
            $order_room->save();

            if (!OrdersRoom::findAll(['order_id' => $order_room->order_id, 'status' => 1])) {
                $order->canceled = $time;
                $order->status = 2;
                $order->save();
            }

            $mail = \Yii::$app->mailer->compose(['html' => 'orderRoomCancelConfirmation-html'/*, 'text' => 'orderRoomCancelConfirmation-text'*/], [
                'order' => $order,
                'order_room' => $order_room
            ])->setFrom(\Yii::$app->params['infoEmail'])
                ->setTo($order->email)
                ->setSubject(\Yii::t('order', 'Cancellation details').'. '.\Yii::t('main', 'Hotel').' YOUR HOME');

            if (!$mail->send())
                throw new Exception('Order room cancel confirm email was not send');

            $transaction->commit();
            return $order->id;
        } catch(Exception $ex) {
            $transaction->rollBack();
            \Yii::error('Remove order room: '.$ex->getMessage().' '.$ex->getLine());
        }

        return false;
    }

}