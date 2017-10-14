<?php
namespace frontend\models;

use yii\base\Model;

class OrderForm extends Model {
    public $start_date;
    public $end_date;

    public function rules() {
        return [
            [['start_date', 'end_date'], 'required'],
            [['start_date', 'end_date'], 'date', 'format' => 'php:m/d/Y'],
            ['start_date', function($attribute, $params, $validator) {
                // \Yii::error(time());
                if (strtotime($this->end_date) - strtotime($this->start_date) < 86400) {
                    $this->addError($attribute, 'Incorrect date');
                }
            }]
        ];
    }
}
