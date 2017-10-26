<?php
namespace common\api\models\response;

class RoomsWithServicesRow implements \JsonSerializable {
    private $id;
    private $name;
    private $services = [];

    public function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }

    public function setService($service) {
        $this->services[] = $service;
    }

    public function __get($field) {
        switch($field) {
            case 'id':
                return $this->id;
                break;
            case 'name':
                return $this->name;
                break;
            case 'services':
                return $this->services;
                break;
            default:
                throw new \Exception("Invalid property: '" . $field . "'");
        }
    }

    function jsonSerialize() {
        return (object)get_object_vars($this);
    }
}