<?php
namespace frontend\models;

use yii\base\Model;

class OrderStep2 extends Model {
    public $start_date;
    public $end_date;
    public $room_id;
    public $quantity;
    public $first_name;
    public $last_name;
    public $email;
    public $email_confirm;
    public $country;
    public $city;
    public $address;
    public $zip_code;
    public $mobile;
    public $comment;
    public $arrival_time;

    public function rules() {
        return [
            [['start_date', 'end_date', 'room_id', 'quantity', 'first_name', 'last_name', 'email', 'email_confirm', 'country', 'city', 'address', 'mobile'], 'required'],
            [['first_name', 'last_name', 'email', 'email_confirm', 'city', 'address', 'mobile', 'zip_code', 'comment', 'arrival_time'], 'trim'],
            ['email', 'email'],
            ['email_confirm', 'compare', 'compareAttribute' => 'email']
        ];
    }

    public function attributeLabels() {
        return [
            'first_name' => \Yii::t('order', 'First name').' *',
            'last_name' => \Yii::t('order', 'Last name').' *',
            'email' => \Yii::t('order', 'Email').' *',
            'country' => \Yii::t('order', 'Country').' *',
            'city' => \Yii::t('order', 'city').' *',
            'address' => \Yii::t('order', 'Address').' *',
            'zip_code' => \Yii::t('order', 'Zip code'),
            'mobile' => \Yii::t('order', 'Mobile').' *',
            'comment' => \Yii::t('order', 'Special requests'),
            'arrival_time' => \Yii::t('order', 'Approximate arrival time')
        ];
    }

    public function saveOrder() {

    }

}