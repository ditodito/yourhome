<?php
namespace common\api\models\response;

class ToursRow implements \JsonSerializable {
    protected $id;
    protected $title;
    protected $image;

    public function __construct($id, $title, $image) {
        $this->id = $id;
        $this->title = $title;
        $this->image = $image;
    }

    public function __get($field) {
        switch($field) {
            case 'id':
                return $this->id;
                break;
            case 'title':
                return $this->title;
                break;
            case 'image':
                return $this->image;
                break;
            default:
                throw new \Exception("Invalid property: '" . $field . "'");
        }
    }

    function jsonSerialize() {
        return (object)get_object_vars($this);
    }
}