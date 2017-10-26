<?php
namespace common\api\models\database;

use yii\db\ActiveRecord;

/**
 * Class Rooms Services
 *
 * @package api\models\database
 *
 * @property integer $id
 * @property string $name_us
 * @property string $name_ge
 * @property string $name_ru
 * @property integer $price
 * @property integer $per_day
 */
class RoomsServices extends ActiveRecord {

    public static function tableName() {
        return 'rooms_services';
    }

    public function getRoom() {
        return $this->hasOne(Rooms::className(), ['id' => 'room_id']);
    }

}