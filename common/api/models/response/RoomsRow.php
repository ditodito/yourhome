<?php
namespace common\api\models\response;

class RoomsRow implements \JsonSerializable {
    protected $id;
    protected $name;
    protected $description;
    protected $image;
    protected $capacity;
    protected $price;
    protected $free_wifi;
    protected $tv;
    protected $air_conditioning;
    protected $shared_bathroom;
    protected $private_bathroom;
    protected $hairdrayer;
    protected $heating;
    protected $linen;
    protected $shared_kitchenette;
    protected $private_kitchenette;
    protected $non_smoking;
    protected $toiletries;
    protected $towels;
    protected $slippers;

    public function __construct($row) {
        $this->id = $row['id'];
        $this->name = \Yii::t('rooms', $row['name']);
        $this->description = \Yii::t('rooms', $row['description']);
        $this->image = $row['image'];
        $this->capacity = $row['capacity'];
        $this->price = $row['price'];
        $this->free_wifi = $row['free_wifi'];
        $this->tv = $row['tv'];
        $this->air_conditioning = $row['air_conditioning'];
        $this->shared_bathroom = $row['shared_bathroom'];
        $this->private_bathroom = $row['private_bathroom'];
        $this->hairdrayer = $row['hairdrayer'];
        $this->heating = $row['heating'];
        $this->linen = $row['linen'];
        $this->shared_kitchenette = $row['shared_kitchenette'];
        $this->private_kitchenette = $row['private_kitchenette'];
        $this->non_smoking = $row['non_smoking'];
        $this->toiletries = $row['toiletries'];
        $this->towels = $row['towels'];
        $this->slippers = $row['slippers'];

    }

    public function __get($field) {
        switch($field) {
            case 'id':
                return $this->id;
                break;
            case 'name':
                return $this->name;
                break;
            case 'description':
                return $this->description;
                break;
            case 'image':
                return $this->image;
                break;
            case 'capacity':
                return $this->capacity;
                break;
            case 'price':
                return $this->price;
                break;
            case 'free_wifi':
                return $this->free_wifi;
                break;
            case 'tv':
                return $this->tv;
                break;
            case 'air_conditioning':
                return $this->air_conditioning;
                break;
            case 'shared_bathroom':
                return $this->shared_bathroom;
                break;
            case 'private_bathroom':
                return $this->private_bathroom;
                break;
            case 'hairdrayer':
                return $this->hairdrayer;
                break;
            case 'heating':
                return $this->heating;
                break;
            case 'linen':
                return $this->linen;
                break;
            case 'shared_kitchenette':
                return $this->shared_kitchenette;
                break;
            case 'private_kitchenette':
                return $this->private_kitchenette;
                break;
            case 'non_smoking':
                return $this->non_smoking;
                break;
            case 'toiletries':
                return $this->toiletries;
                break;
            case 'towels':
                return $this->towels;
                break;
            case 'slippers':
                return $this->slippers;
                break;
            default:
                throw new \Exception("Invalid property: '" . $field . "'");
        }
    }

    function jsonSerialize() {
        return (object)get_object_vars($this);
    }
}