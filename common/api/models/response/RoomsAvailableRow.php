<?php
namespace common\api\models\response;

class RoomsAvailableRow implements \JsonSerializable {
    protected $id;
    protected $name;
    protected $capacity;
    protected $price;
    protected $available_rooms;

    public function __construct($row) {
        $this->id = $row['id'];
        $this->name = self::resolveName($row);
        $this->capacity = $row['capacity'];
        $this->price = $row['price'];
        $this->available_rooms = $row['available_rooms'];
    }

    private function resolveName($row) {
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
        return $name;
    }

    public function __get($field) {
        switch($field) {
            case 'id':
                return $this->id;
                break;
            case 'name':
                return $this->name;
                break;
            case 'capacity':
                return $this->capacity;
                break;
            case 'price':
                return $this->price;
                break;
            case 'available_rooms':
                return $this->available_rooms;
                break;
            default:
                throw new \Exception("Invalid property: '" . $field . "'");
        }
    }

    function jsonSerialize() {
        return (object)get_object_vars($this);
    }
}