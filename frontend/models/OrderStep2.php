<?php
namespace frontend\models;

use common\api\models\database\Orders;
use common\api\models\database\Rooms;
use yii\base\Model;
use yii\db\Exception;

class OrderStep2 extends Model {
    public $start_date;
    public $end_date;
    public $room_ids;
    public $capacities;
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

    public $airport_transfer_price_id;
    public $parking_reservation;
    public $breakfast;

    public function rules() {
        return [
            [['room_ids', 'capacities', 'first_name', 'last_name', 'email', 'email_confirm',
                'country', 'city', 'address', 'mobile', 'start_date', 'end_date'], 'required'],
            [['zip_code', 'comment', 'arrival_time', 'airport_transfer_price_id', 'parking_reservation', 'breakfast'], 'safe'],
            [['room_ids', 'capacities', 'first_name', 'last_name', 'email', 'email_confirm',
                'city', 'address', 'zip_code', 'mobile', 'comment', 'arrival_time'], 'trim'],
            ['email', 'email'],
            ['email_confirm', 'compare', 'compareAttribute' => 'email'],
            ['start_date', 'date', 'format' => 'php:Y-m-d'],
            ['start_date', function($attribute, $params, $validator) {
                if (strtotime($this->end_date) - strtotime($this->start_date) < 86400) {
                    $this->addError($attribute, 'Incorrect date');
                }
            }],
            ['country', 'exist', 'targetClass' => 'common\api\models\database\Countries', 'targetAttribute' => 'id'],
            ['airport_transfer_price_id', 'exist', 'targetClass' => 'common\api\models\database\AirportTransferPrices', 'targetAttribute' => 'id']
        ];
    }

    public function attributeLabels() {
        return [
            'first_name' => \Yii::t('order', 'First name').' *',
            'last_name' => \Yii::t('order', 'Last name').' *',
            'email' => \Yii::t('contacts', 'E-mail').' *',
            'country' => \Yii::t('order', 'Country').' *',
            'city' => \Yii::t('order', 'City').' *',
            'address' => \Yii::t('contacts', 'Address').' *',
            'zip_code' => \Yii::t('order', 'Zip code'),
            'mobile' => \Yii::t('order', 'Mobile').' *',
            'comment' => \Yii::t('order', 'Special requests'),
            'arrival_time' => \Yii::t('order', 'Approximate arrival time'),

            'parking_reservation' => \Yii::t('services', 'Free private parking'),
            'breakfast' => \Yii::t('services', 'Breakfast')
        ];
    }

    public function saveOrder() {
        if ($this->validate()) {
            $room_ids = explode(',', $this->room_ids);
            $capacities = explode(',', $this->capacities);

            $transaction = \Yii::$app->db->beginTransaction();
            try {
                foreach ($room_ids as $key => $room_id) {
                    //if (!$room_id)
                        //continue;

                    $room = Rooms::findOne(['id' => $room_id]);
                    if (!$room)
                        continue;

                    $order = new Orders();
                    $order->room_id = $room_id;
                    $order->capacity = $capacities[$key];
                    $order->first_name = $this->first_name;
                    $order->last_name = $this->last_name;
                    $order->email = $this->email;
                    $order->country_id = $this->country;
                    $order->city = $this->city;
                    $order->address = $this->address;
                    if ($this->zip_code)
                        $order->zip_code = $this->zip_code;
                    $order->mobile = $this->mobile;
                    if ($this->comment)
                        $order->comment = $this->comment;
                    if ($this->arrival_time)
                        $order->arrival_time = $this->arrival_time;

                    if ($this->airport_transfer_price_id)
                        $order->airport_transfer_price_id = $this->airport_transfer_price_id;
                    $order->parking_reservation = $this->parking_reservation;
                    $order->breakfast = $this->breakfast;

                    $order->start_date = $this->start_date;
                    $order->end_date = $this->end_date;
                    $order->save();
                }

                $transaction->commit();
                return true;
            } catch(Exception $ex) {
                $transaction->rollBack();
                \Yii::error('Add order '.$ex->getMessage());
            }

            return false;
        }

        return false;
    }

}