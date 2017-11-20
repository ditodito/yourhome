<?php
namespace backend\models\orders;

use common\api\models\database\Orders;
use yii\base\Model;
use yii\db\Exception;

class OrdersModel extends Model {
    public $id;
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
            [['first_name', 'last_name', 'email', 'country', 'city', 'address', 'mobile', 'start_date', 'end_date', 'status'], 'required'],
            [['id', 'zip_code', 'comment', 'arrival_time', 'airport_transfer_price_id', 'parking_reservation'], 'safe'],
            [['first_name', 'last_name', 'email', 'city', 'address', 'zip_code', 'mobile', 'comment', 'arrival_time'], 'trim'],
            ['email', 'email'],
            ['country', 'exist', 'targetClass' => 'common\api\models\database\Countries', 'targetAttribute' => 'id'],
            ['airport_transfer_price_id', 'exist', 'targetClass' => 'common\api\models\database\AirportTransferPrices', 'targetAttribute' => 'id'],
            ['start_date', 'date', 'format' => 'php:m/d/Y'],
            ['start_date', function($attribute, $params, $validator) {
                // $formatter = \Yii::$app->formatter;
                // \Yii::error($formatter->asDate($this->start_date, 'php:Y-m-d'));
                // \Yii::error($this->start_date.' : '.strtotime($this->start_date).' : '.$formatter->asTimestamp($this->start_date));
                // \Yii::error($this->end_date.' : '.strtotime($this->end_date)).' : '.$formatter->asTimestamp($this->end_date);
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

        if (!$this->validate())
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
                $order->created = time();
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
            $order->canceled = ($this->status == 1) ? null : time();
            $order->status = $this->status;
            $order->save();

            $transaction->commit();
            return true;
        } catch(Exception $ex) {
            $transaction->rollBack();
            \Yii::error('Add order from admin: '.$ex->getMessage().'; Line: '.$ex->getLine());
        }
        return true;
    }

}