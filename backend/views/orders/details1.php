<?php
use kartik\date\DatePicker;
use kartik\time\TimePicker;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;

$this->title = 'YourHomeHotel :: Admin Page';
?>

<div class="row">
    <div class="col-md-1 form-group">
        <?=Html::a('&laquo; '.\Yii::t('main', 'Back'), ['orders/'], ['class' => 'btn btn-primary'])?>
    </div>
</div>
<div class="row">
    <?php $form = ActiveForm::begin(['action' => ['orders/save'], /*'layout' => 'horizontal'*/]); ?>
    <?=Html::activeHiddenInput($model, 'id')?>
    <div class="col-md-6">
        <?=$form->field($model, 'first_name')->error(false)?>
        <?=$form->field($model, 'last_name')->error(false)?>
        <?=$form->field($model, 'email')->error(false)?>
        <?=$form->field($model, 'country')->dropDownList(ArrayHelper::map($countries, 'id', 'country_name'), [
            'prompt' => \Yii::t('order', 'Select country')
        ])->error(false)?>
        <?=$form->field($model, 'city')->error(false)?>
        <?=$form->field($model, 'address')->error(false)?>
        <?=$form->field($model, 'zip_code')?>
        <?=$form->field($model, 'mobile')->error(false)?>
        <?=$form->field($model, 'comment')->textarea(['rows' => 5])?>
        <?=$form->field($model, 'arrival_time')->widget(TimePicker::classname(), [
            'pluginOptions' => [
                'minuteStep' => 5,
                'defaultTime' => false,
                'showInputs' => false,
                'showMeridian' => false
            ]
        ])?>
        <?=$form->field($model, 'airport_transfer_price_id')->dropDownList(ArrayHelper::map($airportTransferPrices, 'id', 'name'), [
            'prompt' => \Yii::t('order', 'Select number of passengers'),
        ])?>
        <?=$form->field($model, 'parking_reservation')->checkbox()?>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-6">
                <?=$form->field($model, 'start_date')->widget(DatePicker::classname(), [
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'pickerButton' => ['title' => false],
                    'removeButton' => false,
                    // 'options' => ['value' => date('m/d/Y', time())],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'mm/dd/yyyy',
                        'startDate' => date('m/d/Y', time())
                    ],
                    'pluginEvents' => [
                        "clearDate" => "function(e) {
                            // $('#ordersmodel-end_date').kvDatepicker('clearDates');
                        }",
                        "changeDate" => "function(e) {
                            // $('#ordersmodel-end_date').kvDatepicker('clearDates');
                            // var start_day = new Date($('#ordersmodel-start_date').val());
                            // var next_day = new Date(start_day.getTime() + 86400000);
                            // $('#ordersmodel-end_date').kvDatepicker('setStartDate', next_day.toLocaleDateString());
                        }"
                    ]
                ])->error(false)?>
            </div>
            <div class="col-md-6">
                <?=$form->field($model, 'end_date')->widget(DatePicker::classname(), [
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'pickerButton' => ['title' => false],
                    'removeButton' => false,
                    // 'options' => ['value' => date('m/d/Y', strtotime('+1 days'))],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'mm/dd/yyyy',
                        'startDate' => date('m/d/Y', strtotime('+1 days'))
                    ]
                ])->error(false)?>
            </div>
        </div>
        <?=$form->field($model, 'status')->dropDownList([1 => 'აქტიური', 2 => 'გაუქმებული'])->error(false)?>

        <?=Html::submitButton('Save', ['class' => 'btn btn-primary'])?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

