<?php
namespace common\api\models\response;

class RoomServiceRow implements \JsonSerializable {
    private $id;
    private $name;
    private $price;
    private $per_night;

    public function __construct($id, $name, $price, $per_night) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->per_night = $per_night;
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
            case 'per_night':
                return $this->per_night;
                break;
            default:
                throw new \Exception("Invalid property: '" . $field . "'");
        }
    }

    function jsonSerialize() {
        return (object)get_object_vars($this);
    }
}