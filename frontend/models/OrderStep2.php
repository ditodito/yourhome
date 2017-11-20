<?php
namespace frontend\models;

use common\api\models\database\Orders;
use common\api\models\database\OrdersRoom;
use common\api\models\database\OrdersRoomServices;
use common\api\models\database\Rooms;
use common\api\models\database\RoomsServices;
use yii\base\Model;
use yii\base\Exception;

class OrderStep2 extends Model {
    public $rooms;
    public $quantities;
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
    public $start_date;
    public $end_date;
    public $room_services;

    public function rules() {
        return [
            [['rooms', 'quantities', 'first_name', 'last_name', 'email', 'email_confirm',
                'country', 'city', 'address', 'mobile', 'start_date', 'end_date'], 'required'],
            [['zip_code', 'comment', 'arrival_time', 'airport_transfer_price_id', 'parking_reservation', 'room_services'], 'safe'],
            [['first_name', 'last_name', 'email', 'email_confirm', 'city', 'address', 'zip_code', 'mobile', 'comment', 'arrival_time'], 'trim'],
            ['email', 'email'],
            ['email_confirm', 'compare', 'compareAttribute' => 'email'],
            ['country', 'exist', 'targetClass' => 'common\api\models\database\Countries', 'targetAttribute' => 'id'],
            ['airport_transfer_price_id', 'exist', 'targetClass' => 'common\api\models\database\AirportTransferPrices', 'targetAttribute' => 'id'],
            ['start_date', 'date', 'format' => 'php:Y-m-d'],
            ['start_date', function($attribute, $params, $validator) {
                if (strtotime($this->end_date) - strtotime($this->start_date) < 86400) {
                    $this->addError($attribute, 'Incorrect date');
                }
            }]
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
            'comment' => \Yii::t('order', 'Special request'),
            'arrival_time' => \Yii::t('order', 'Approximate arrival time'),
            'airport_transfer_price_id' => \Yii::t('services', 'Airport transfer'),
            'parking_reservation' => \Yii::t('services', 'Free private parking')
        ];
    }

    public function saveOrder() {
        if ($this->validate()) {
            $rooms = explode(',', $this->rooms);
            $quantities = explode(',', $this->quantities);
            $room_services = $this->room_services ? explode(',', $this->room_services) : [];
            $time = time();

            $transaction = \Yii::$app->db->beginTransaction();
            try {
                $order = new Orders();
                $order->order_key = \Yii::$app->security->generateRandomString();
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
                $order->start_date = $this->start_date;
                $order->end_date = $this->end_date;
                $order->created = $time;
                $order->save();

                foreach($rooms as $key => $room_id) {
                    $room = Rooms::findOne(['id' => $room_id]);
                    if (!$room)
                        throw new Exception('Invalid room id');

                    for($i = 0; $i < $quantities[$key]; $i++) {
                        $order_rooms = new OrdersRoom();
                        $order_rooms->order_id = $order->id;
                        $order_rooms->room_id = $room_id;
                        $order_rooms->created = $time;
                        $order_rooms->save();

                        foreach($room_services as $service) {
                            $r = explode('-', $service);
                            $ind = $r[0];
                            $rid = $r[1];
                            $sid = $r[2];

                            $room_service = RoomsServices::findOne(['id' => $sid, 'room_id' => $rid]);
                            if (!$room_service)
                                throw new Exception('Invalid service id');

                            if ($room_id == $rid && $i == $ind) {
                                $order_room_service = new OrdersRoomServices();
                                $order_room_service->order_room_id = $order_rooms->id;
                                $order_room_service->room_service_id = $sid;
                                $order_room_service->save();
                            }
                        }
                    }
                }

                $mail = \Yii::$app->mailer->compose(['html' => 'orderConfirmation-html'/*, 'text' => 'orderConfirmation-text'*/], [
                    'logo' => \Yii::getAlias('@common/mail/img/logo.png'),
                    'order' => $order
                ])->setFrom(\Yii::$app->params['infoEmail'])
                  ->setTo($order->email)
                  ->setSubject(\Yii::t('order', 'Reservation confirmation').'. '.\Yii::t('main', 'Hotel').' YOUR HOME');

                if (!$mail->send())
                    throw new Exception('Order confirm email was not send');

                $transaction->commit();
                return true;
            } catch(Exception $ex) {
                $transaction->rollBack();
                \Yii::error('Add order: '.$ex->getMessage().'; Line: '.$ex->getLine());
            }

            return false;
        }

        return false;
    }

}