<?php
namespace common\api\actions;

use common\api\models\database\AirportTransferPrices;
use common\api\models\response\IdNamePair;
use common\api\models\response\IdNamePairPlus;

class OrderActions {

    public static function getAirportTransferPrices() {
        $rows = AirportTransferPrices::find()->all();
        $result = [];

        foreach($rows as $row) {
            $result[] = new IdNamePair($row['id'], $row['persons'].'p - '.$row['price'].' GEL');
        }

        return $result;
    }

}