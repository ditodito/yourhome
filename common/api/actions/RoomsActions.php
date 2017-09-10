<?php
namespace common\api\actions;

use common\api\models\database\Rooms;
use common\api\models\response\RoomsRow;

class RoomsActions {

    public static function getRooms() {
        $rooms = Rooms::find()->all();
        $result = [];
        foreach($rooms as $room) {
            $result[] = new RoomsRow($room);
        }
        return $result;
    }

}