<?php
namespace common\api\models\response;

class ToursRow implements \JsonSerializable {
    protected $id;
    protected $title;
    protected $image;
    protected $image_large;
    protected $duration;

    public function __construct($id, $title, $image, $image_large) {
        $this->id = $id;
        $this->title = $title;
        $this->image = $image;
        $this->image_large = $image_large;
    }

    public function setDuration($duration) {
        $this->duration = $duration;
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
            case 'image_large':
                return $this->image_large;
                break;
            case 'duration':
                return $this->duration;
                break;
            default:
                throw new \Exception("Invalid property: '" . $field . "'");
        }
    }

    function jsonSerialize() {
        return (object)get_object_vars($this);
    }
}