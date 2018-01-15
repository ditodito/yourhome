<?php
namespace common\api\models\response;

class ToursDetailsRow extends ToursRow implements \JsonSerializable {
    protected $text;

    public function __construct($id, $title, $text, $image, $image_large) {
        parent::__construct($id, $title, $image, $image_large);
        $this->text = $text;
    }

    public function __get($field) {
        switch($field) {
            case 'id':
                return $this->id;
                break;
            case 'title':
                return $this->title;
                break;
            case 'text':
                return $this->text;
                break;
            case 'image':
                return $this->image;
                break;
            case 'image_large':
                return $this->image_large;
                break;
            default:
                throw new \Exception("Invalid property: '" . $field . "'");
        }
    }

    function jsonSerialize() {
        return (object)get_object_vars($this);
    }
}