<?php
namespace backend\models\rooms;

use common\api\models\database\Rooms;
use yii\base\Model;
use yii\web\UploadedFile;

class RoomsModel extends Model {
    public $id;
    public $name_us;
    public $name_ge;
    public $name_ru;
    public $description_us;
    public $description_ge;
    public $description_ru;
    public $image;
    public $quantity;
    public $capacity;
    public $is_hostel;
    public $price;
    public $free_wifi;
    public $tv;
    public $air_conditioning;
    public $shared_bathroom;
    public $private_bathroom;
    public $hairdrayer;
    public $heating;
    public $linen;
    public $shared_kitchenette;
    public $private_kitchenette;
    public $non_smoking;
    public $toiletries;
    public $towels;
    public $slippers;


    public function rules() {
        return [
            [['name_us', 'name_ge', 'name_ru', 'description_us', 'description_ge', 'description_ru', 'quantity', 'capacity', 'is_hostel', 'price'], 'required'],
            [['id', 'free_wifi', 'tv', 'air_conditioning', 'shared_bathroom', 'private_bathroom', 'hairdrayer', 'heating', 'linen',
                'shared_kitchenette', 'private_kitchenette', 'non_smoking', 'toiletries', 'towels', 'slippers'], 'safe'],
            [['name_us', 'name_ge', 'name_ru', 'description_us', 'description_ge', 'description_ru'], 'trim'],
            [['quantity', 'capacity', 'price'], 'integer', 'min' => 1],
            ['image', 'file', 'extensions' => ['jpg', 'png'], 'maxSize' => 1024 * 500,
                'wrongExtension' => 'აირჩიეთ შემდეგი ფორმატის სურათი: jpg, png',
                'tooBig' => 'სურათის ზომა არ უნდა აღემატებოდეს 500 KB-ს'
            ]
        ];
    }

    public function attributeLabels() {
        return [
            'image' => 'სურათი',
            'price' => \Yii::t('order', 'Price'),
            'free_wifi' => \Yii::t('main', 'Free').' WiFi',
            'tv' => \Yii::t('rooms', 'TV'),
            'air_conditioning' => \Yii::t('rooms', 'Air conditioning'),
            'shared_bathroom' => \Yii::t('rooms', 'Shared bathroom'),
            'private_bathroom' => \Yii::t('rooms', 'Private bathroom'),
            'heating' => \Yii::t('rooms', 'Heating'),
            'linen' => \Yii::t('rooms', 'Linen'),
            'shared_kitchenette' => \Yii::t('rooms', 'Shared kitchenette'),
            'private_kitchenette' => \Yii::t('rooms', 'Private kitchenette'),
            'non_smoking' => \Yii::t('rooms', 'Non smoking'),
            'toiletries' => \Yii::t('rooms', 'Toiletries'),
            'towels' => \Yii::t('rooms', 'Towels'),
            'slippers' => \Yii::t('rooms', 'Slippers')
        ];
    }

    public function save() {
        if (!$this->validate())
            return false;

        $file_name = null;

        $uploaded_file = UploadedFile::getInstance($this, 'image');
        if ($uploaded_file) {
            $file_name = \Yii::$app->security->generateRandomString().'.'.$uploaded_file->getExtension();
            if (!$uploaded_file->saveAs(\Yii::getAlias('@frontend_web/img/rooms/'.$file_name)))
                return false;
        }

        if ($this->id) {
            $room = Rooms::findOne(['id' => $this->id]);
            if (!$room)
                return false;
        } else {
            $room = new Rooms();
        }
        $room->name_us = $this->name_us;
        $room->name_ge = $this->name_ge;
        $room->name_ru = $this->name_ru;
        $room->description_us = $this->description_us;
        $room->description_ge = $this->description_ge;
        $room->description_ru = $this->description_ru;
        if ($file_name)
            $room->image = $file_name;
        $room->quantity = $this->quantity;
        $room->capacity = $this->capacity;
        $room->is_hostel = $this->is_hostel;
        $room->price = $this->price;
        $room->free_wifi = $this->free_wifi;
        $room->tv = $this->tv;
        $room->air_conditioning = $this->air_conditioning;
        $room->shared_bathroom = $this->shared_bathroom;
        $room->private_bathroom = $this->private_bathroom;
        $room->hairdrayer = $this->hairdrayer;
        $room->heating = $this->heating;
        $room->linen = $this->linen;
        $room->shared_kitchenette = $this->shared_kitchenette;
        $room->private_kitchenette = $this->private_kitchenette;
        $room->non_smoking = $this->non_smoking;
        $room->toiletries = $this->toiletries;
        $room->towels = $this->towels;
        $room->slippers = $this->slippers;
        if ($room->save())
            return true;

        return true;
    }
}