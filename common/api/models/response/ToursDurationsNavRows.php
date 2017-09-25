<?php
namespace common\api\models\response;

class ToursDurationsNavRows implements \JsonSerializable {
    protected $id;
    protected $name;
    protected $tours = [];

    public function __construct($id, $title, $tours) {
        $this->id = $id;
        $this->name = $title;
        $this->tours = $tours;
    }

    public function __get($field) {
        switch($field) {
            case 'id':
                return $this->id;
                break;
            case 'name':
                return $this->name;
                break;
            case 'tours':
                return $this->tours;
                break;
            default:
                throw new \Exception("Invalid property: '" . $field . "'");
        }
    }

    function jsonSerialize() {
        return (object)get_object_vars($this);
    }
}