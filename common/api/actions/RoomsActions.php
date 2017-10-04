<?php
namespace common\api\actions;

use common\api\models\database\Rooms;
use common\api\models\response\IdNamePair;
use common\api\models\response\RoomsRow;

class RoomsActions {

    public static function getRoomsTitle() {
        $rows = Rooms::find()->all();
        $result = [];

        foreach($rows as $row) {
            switch(\Yii::$app->language) {
                case 'ka-GE':
                    $name = $row['name_ge'];
                    break;
                case 'ru-RU':
                    $name = $row['name_ru'];
                    break;
                default:
                    $name = $row['name_us'];
            }
            $result[] = new IdNamePair($row['id'], $name);
        }

        return $result;

    }

    public static function getRooms() {
        $rows = Rooms::find()->all();
        $result = [];

        foreach($rows as $row) {
            $result[] = new RoomsRow($row);
        }

        return $result;
    }

}