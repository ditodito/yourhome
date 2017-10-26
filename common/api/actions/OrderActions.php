<?php
namespace common\api\actions;

use common\api\models\database\AirportTransferPrices;
use common\api\models\database\Orders;
use common\api\models\database\OrdersRoom;
use common\api\models\response\IdNamePair;
use common\api\models\response\IdNamePairPlus;
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
            OrdersRoom::deleteAll(['order_id' => $order->id]);
            $transaction->commit();
            return true;
        } catch(Exception $ex) {
            $transaction->rollBack();
            \Yii::error('Remove order '.$ex->getMessage().' '.$ex->getLine());
        }

        return false;
    }

}