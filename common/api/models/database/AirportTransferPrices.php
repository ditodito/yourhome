<?php
namespace common\api\models\database;

use yii\db\ActiveRecord;

/**
 * Class AirportTransferPrices
 *
 * @package api\models\database
 *
 * @property integer $id
 * @property string $persons
 * @property string $price
 */
class AirportTransferPrices extends ActiveRecord {

    public static function tableName() {
        return 'airport_transfer_prices';
    }

    public function getOrders() {
        return $this->hasMany(Orders::className(), ['airport_transfer_price_id' => 'id']);
    }

}