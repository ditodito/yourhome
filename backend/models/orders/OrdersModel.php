<?php
namespace backend\models\orders;

use common\api\models\database\AirportTransferPrices;
use common\api\models\database\Orders;
use common\api\models\database\OrdersRoom;
use common\api\models\database\Rooms;
use yii\base\Model;
use yii\db\Exception;

class OrdersModel extends Model {
    public $id;
    public $rooms;
    public $first_name;
    public $last_name;
    public $email;
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
    public $status;

    public function rules() {
        return [
            [['rooms', 'first_name', 'last_name', 'email', 'country', 'city', 'address', 'mobile', 'start_date', 'end_date', 'status'], 'required'],
            [['id', 'zip_code', 'comment', 'arrival_time', 'airport_transfer_price_id', 'parking_reservation'], 'safe'],
            [['first_name', 'last_name', 'email', 'city', 'address', 'zip_code', 'mobile', 'comment', 'arrival_time'], 'trim'],
            ['email', 'email'],
            ['country', 'exist', 'targetClass' => 'common\api\models\database\Countries', 'targetAttribute' => 'id'],
            ['airport_transfer_price_id', 'exist', 'targetClass' => 'common\api\models\database\AirportTransferPrices', 'targetAttribute' => 'id'],
            ['start_date', 'date', 'format' => 'php:m/d/Y'],
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
            'parking_reservation' => \Yii::t('services', 'Free private parking'),
            'start_date' => \Yii::t('order', 'Check in'),
            'end_date' => \Yii::t('order', 'Check out'),
            'status' => \Yii::t('order', 'Status')
        ];
    }

    public function save() {
        $formatter = \Yii::$app->formatter;
        $time = time();
        $total_days = floor((strtotime($this->end_date) - strtotime($this->start_date)) / 86400);
        $total_price = 0;

        if (!$this->validate())
            return false;

        $rooms = explode(',', $this->rooms);
        if (count($rooms) == 0)
            return false;

        $transaction = \Yii::$app->db->beginTransaction();
        try {
            if ($this->id) {
                $order = Orders::findOne(['id' => $this->id]);
                if (!$order)
                    return false;
            } else {
                $order = new Orders();
                $order->order_key = \Yii::$app->security->generateRandomString();
                $order->created = $time;
            }

            $order->first_name = $this->first_name;
            $order->last_name = $this->last_name;
            $order->email = $this->email;
            $order->country_id = $this->country;
            $order->city = $this->city;
            $order->address = $this->address;
            $order->zip_code = ($this->zip_code) ? $this->zip_code : null;
            $order->mobile = $this->mobile;
            $order->comment = ($this->comment) ? $this->comment : null;
            $order->arrival_time = ($this->arrival_time) ? $this->arrival_time : null;
            $order->airport_transfer_price_id = ($this->airport_transfer_price_id) ? $this->airport_transfer_price_id : null;
            $order->parking_reservation = $this->parking_reservation;
            $order->start_date = $formatter->asDate($this->start_date, 'php:Y-m-d');
            $order->end_date = $formatter->asDate($this->end_date, 'php:Y-m-d');
            $order->canceled = ($this->status == 1) ? null : $time;
            $order->status = $this->status;
            $order->save();

            if (!$this->id) {
                foreach($rooms as $room) {
                    $room = explode('-', $room);
                    $room_id = $room[0];
                    $quantity = $room[1];

                    $room = Rooms::findOne(['id' => $room_id]);
                    if (!$room)
                        throw new Exception('Invalid room id');

                    $error = ($room->is_hostel) ? ($room->capacity < $quantity) : ($room->quantity < $quantity);
                    if ($error)
                        throw new Exception('Invalid parameter for order room');

                    for($i = 0; $i < $quantity; $i++) {
                        $orders_room = new OrdersRoom();
                        $orders_room->order_id = $order->id;
                        $orders_room->room_id = $room_id;
                        $orders_room->price = $room->price;
                        $orders_room->created = $time;
                        $orders_room->canceled = ($this->status == 1) ? null : $time;
                        $orders_room->save();

                        $total_price += $room->price * $total_days;
                    }
                }

                if ($this->airport_transfer_price_id)
                    $total_price += AirportTransferPrices::findOne(['id' => $this->airport_transfer_price_id])->price;
                $order->price = $total_price;
                $order->save();
            }

            $transaction->commit();
            return $order->id;
        } catch(Exception $ex) {
            $transaction->rollBack();
            \Yii::error('Add order from admin: '.$ex->getMessage().'; Line: '.$ex->getLine());
        }
        return false;
    }

}