<?php
namespace common\api\models\database;

use yii\db\ActiveRecord;

/**
 * Class Countries
 *
 * @package api\models\database
 *
 * @property integer $id
 * @property string $country_code
 * @property string $country_name
 */
class Countries extends ActiveRecord {

    public static function tableName() {
        return 'countries';
    }

    public function getOrders() {
        return $this->hasOne(Orders::className(), ['country_id' => 'id']);
    }

}