<?php
namespace common\api\models\response;

class ToursDetailsRow extends ToursRow implements \JsonSerializable {
    protected $text;

    public function __construct($id, $title, $text, $image) {
        parent::__construct($id, $title, $image);
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
            default:
                throw new \Exception("Invalid property: '" . $field . "'");
        }
    }

    function jsonSerialize() {
        return (object)get_object_vars($this);
    }
}