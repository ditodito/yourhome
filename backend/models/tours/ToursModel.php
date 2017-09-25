<?php
namespace backend\models\tours;

use common\api\models\database\Tours;
use yii\base\Model;
use yii\web\UploadedFile;

class ToursModel extends Model {
    public $id;
    public $duration_id;
    public $title_us;
    public $title_ge;
    public $title_ru;
    public $text_us;
    public $text_ge;
    public $text_ru;
    public $image;

    public function rules() {
        return [
            [['duration_id', 'title_us', 'title_ge', 'title_ru'], 'required'],
            [['title_us', 'title_ge', 'title_ru', 'text_us', 'text_ge', 'text_ru'], 'trim'],
            ['id', 'safe'],
            ['duration_id', 'integer', 'min' => 1],
            ['image', 'file', 'extensions' => ['jpg', 'png'], 'maxSize' => 1024 * 500,
                'wrongExtension' => 'აირჩიეთ შემდეგი ფორმატის სურათი: jpg, png',
                'tooBig' => 'სურათის ზომა არ უნდა აღემატებოდეს 500 KB-ს'
            ]
        ];
    }

    public function attributeLabels() {
        return [
            'duration_id' => 'ტურის ხანგრძლივობა',
            'title_us' => 'დასახელება (US)',
            'title_ge' => 'დასახელება (GE)',
            'title_ru' => 'დასახელება (RU)',
            'text_us' => 'ტექსტი (US)',
            'text_ge' => 'ტექსტი (GE)',
            'text_ru' => 'ტექსტი (RU)',
            'image' => 'სურათი'
        ];
    }

    public function save() {
        if (!$this->validate()) {
            return false;
        }

        $file_name = null;

        $uploaded_file = UploadedFile::getInstance($this, 'image');
        if ($uploaded_file) {
            $file_name = \Yii::$app->security->generateRandomString().'.'.$uploaded_file->getExtension();
            if (!$uploaded_file->saveAs(\Yii::getAlias('@frontend_web/img/tours/'.$file_name))) {
                return false;
            }
        }

        if ($this->id) {
            $tour = Tours::findOne(['id' => $this->id]);
            if (!$tour) {
                return false;
            }
        } else {
            $tour = new Tours();
        }
        $tour->duration_id = $this->duration_id;
        $tour->title_us = $this->title_us;
        $tour->title_ge = $this->title_ge;
        $tour->title_ru = $this->title_ru;
        $tour->text_us = $this->text_us;
        $tour->text_ge = $this->text_ge;
        $tour->text_ru = $this->text_ru;
        if ($file_name)
            $tour->image = $file_name;
        if ($tour->save()) {
            return true;
        }

        return false;
    }

}