<?php
namespace common\api\models\response;

class RoomServiceRow implements \JsonSerializable {
    private $id;
    private $name;
    private $price;
    private $per_day;

    public function __construct($id, $name, $price, $per_day) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->per_day = $per_day;
    }

    public function __get($field) {
        switch($field) {
            case 'id':
                return $this->id;
                break;
            case 'name':
                return $this->name;
                break;
            case 'price':
                return $this->price;
                break;
            case 'per_day':
                return $this->per_day;
                break;
            default:
                throw new \Exception("Invalid property: '" . $field . "'");
        }
    }

    function jsonSerialize() {
        return (object)get_object_vars($this);
    }
}