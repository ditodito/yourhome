<?php
namespace common\api\actions;

use common\api\models\database\Rooms;
use common\api\models\response\RoomsRow;

class RoomsActions {

    public static function getRooms() {
        $rows = Rooms::find()->all();
        $result = [];
        foreach($rows as $row) {
            $result[] = new RoomsRow($row);
        }
        return $result;
    }

}