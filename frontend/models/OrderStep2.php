<?php
namespace frontend\models;

use common\api\models\database\AirportTransferPrices;
use common\api\models\database\Orders;
use common\api\models\database\OrdersRoom;
use common\api\models\database\OrdersRoomServices;
use common\api\models\database\Rooms;
use common\api\models\database\RoomsServices;
use yii\base\Model;
use yii\base\Exception;

class OrderStep2 extends Model {
    public $rooms;
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
            [['rooms', 'first_name', 'last_name', 'email', 'email_confirm',
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
            'email_confirm' => \Yii::t('contacts', 'Confirm email'),
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
            $room_services = $this->room_services ? explode(',', $this->room_services) : [];
            $time = time();
            $total_days = floor((strtotime($this->end_date) - strtotime($this->start_date)) / 86400);
            $total_price = 0;

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

                foreach($rooms as $room) {
                    $params = explode('-', $room);
                    $room_id = $params[0];
                    $quantity = $params[1];

                    $r = Rooms::findOne(['id' => $room_id]);
                    if (!$r)
                        throw new Exception('Invalid room id');

                    for($i = 0; $i < $quantity; $i++) {
                        $orders_room = new OrdersRoom();
                        $orders_room->order_id = $order->id;
                        $orders_room->room_id = $room_id;
                        $orders_room->price = $r->price;
                        $orders_room->created = $time;
                        $orders_room->save();

                        $total_price += $r->price * $total_days;

                        foreach($room_services as $service) {
                            $rs = explode('-', $service);
                            $ind = $rs[0];
                            $rid = $rs[1];
                            $sid = $rs[2];

                            $room_service = RoomsServices::findOne(['id' => $sid, 'room_id' => $rid]);
                            if (!$room_service)
                                throw new Exception('Invalid service id');

                            if ($room_id == $rid && $i == $ind) {
                                $order_room_service = new OrdersRoomServices();
                                $order_room_service->order_room_id = $orders_room->id;
                                $order_room_service->room_service_id = $sid;
                                $order_room_service->price = $room_service->price;
                                $order_room_service->per_night = $room_service->per_night;
                                $order_room_service->save();

                                $total_price += ($room_service->per_night) ? ($room_service->price * $total_days) : $room_service->price;
                            }
                        }
                    }
                }

                if ($this->airport_transfer_price_id)
                    $total_price += AirportTransferPrices::findOne(['id' => $this->airport_transfer_price_id])->price;
                $order->price = $total_price;
                $order->save();

                $mail = \Yii::$app->mailer->compose(['html' => 'orderConfirmation-html'/*, 'text' => 'orderConfirmation-text'*/], [
                    'logo' => \Yii::getAlias('@common/mail/img/logo.png'),
                    'order' => $order
                ])->setFrom(\Yii::$app->params['infoEmail'])
                  ->setTo($order->email)
                  ->setSubject(\Yii::t('order', 'Reservation confirmation').'. '.\Yii::t('main', 'Hotel').' YOUR HOME');

                if (!$mail->send())
                    throw new Exception('Order confirm email was not send');

                $transaction->commit();
                return $order->id;
            } catch(Exception $ex) {
                $transaction->rollBack();
                \Yii::error('Add order: '.$ex->getMessage().'; Line: '.$ex->getLine());
            }

            return false;
        }

        return false;
    }

}