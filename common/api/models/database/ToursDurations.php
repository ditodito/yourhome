<?php
namespace common\api\models\database;

use yii\db\ActiveRecord;

/**
 * Class Tours Durations
 *
 * @package api\models\database
 *
 * @property integer $id
 * @property string $name
 */
class ToursDurations extends ActiveRecord {

    public static function tableName() {
        return 'tours_durations';
    }

    public function getTours() {
        return $this->hasMany(Tours::className(), ['duration_id' => 'id']);
    }

}