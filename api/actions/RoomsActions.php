<?php
namespace api\actions;

use api\model\response\RoomsRow;
use api\models\database\Rooms;

class RoomsActions {

    /*public static function getRooms() {
        $rooms = Rooms::findAll();
        $result = [];
        foreach($rooms as $room) {
            $result[] = new RoomsRow($room);
        }
        return $result;
    }*/

    public static function Td() {
        return "dito";
    }

}