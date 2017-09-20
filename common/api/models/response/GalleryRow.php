<?php
namespace common\api\models\response;

class GalleryRow implements \JsonSerializable {
    protected $image_name;
    protected $image_name_thumb;
    protected $description;

    public function __construct($row) {
        $this->image_name = $row->image_name;
        $this->image_name_thumb = $row->image_name_thumb;
        $this->description = $row->description;
    }

    public function __get($field) {
        switch($field) {
            case 'image_name':
                return $this->image_name;
                break;
            case 'image_name_thumb':
                return $this->image_name_thumb;
                break;
            case 'description':
                return $this->description;
                break;
            default:
                throw new \Exception("Invalid property: '" . $field . "'");
        }
    }

    function jsonSerialize() {
        return (object)get_object_vars($this);
    }
}