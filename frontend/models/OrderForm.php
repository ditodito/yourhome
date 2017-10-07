<?php
namespace frontend\models;

use yii\base\Model;

class OrderForm extends Model {
    public $start_date;
    public $end_date;

    public function rules() {
        return [
            [['start_date', 'end_date'], 'required']
        ];
    }

}