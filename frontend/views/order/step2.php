<?php
use common\api\models\database\Countries;
use common\api\models\database\Rooms;
use frontend\assets\order\Step2Asset;
use kartik\time\TimePicker;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\web\View;

Step2Asset::register($this);

$this->title = 'YourHomeHotel :: Order Step 2';

$this->registerJs("var totalDays = ".$total_days.";", View::POS_HEAD);
?>

<div class="row">
    <div class="col-md-3 form-group">
        <div class="booking-header"><?=\Yii::t('order', 'Your booking details')?></div>
        <div class="booking-details">
            <div>
                <div><strong><?=\Yii::t('order', 'Check in')?></strong></div>
                <div>
                    <?=\Yii::t('day', date('l', $start_date))?>,
                    <?=\Yii::t('month', date('F', $start_date))?> <?=date('d', $start_date)?>,
                    <?=date('Y', $start_date)?>
                    <?=\Yii::t('order', 'From 14:00 (2:00 PM)')?>
                </div>
            </div>
            <div>
                <div><strong><?=\Yii::t('order', 'Check out')?></strong></div>
                <div>
                    <?=\Yii::t('day', date('l', $end_date))?>,
                    <?=\Yii::t('month', date('F', $end_date))?> <?=date('d', $end_date)?>,
                    <?=date('Y', $end_date)?>
                    <?=\Yii::t('order', 'Until 12:00 (noon)')?>
                </div>
            </div>
            <div>
                <div><strong><?=\Yii::t('order', 'Total length of stay')?></strong></div>
                <div><?=$total_days?> <?=\Yii::t('order', 'night')?></div>
            </div>
        </div>

        You selected:
        <?php $index = -1; ?>
        <?php foreach($selectedRooms as $key => $room): ?>
            <div class="booking-extra">
                <?=$room->name?>
                <?php if ($room->services): ?>
                    <?php $index = ($key > 0 && $room != $selectedRooms[$key-1]) ? 0 : ++$index; ?>
                    <?php foreach($room->services as $service): ?>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="room-service" value="<?=$index?>-<?=$room->id?>-<?=$service->id?>" data-price="<?=$service->price?>" data-per-night="<?=$service->per_night?>" />
                                <?=$service->name?> + <?=$service->price?> GEL
                                (<?=($service->per_night == 1) ? \Yii::t('order', 'Per night') : \Yii::t('order', 'One package')?>)
                            </label>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

        <div class="booking-header" style="margin-top: 15px;"><?=\Yii::t('order', 'Your price summary')?></div>
        <div class="booking-details">
            <div>
                <?=\Yii::t('rooms', 'Rooms')?> <div class="pull-right"><span id="roomPrice"><?=$room_price?></span> GEL</div>
            </div>
            <div>
                <?=\Yii::t('services', 'Services')?> <div class="pull-right"><span id="servicePrice">0</span> GEL</div>
            </div>
            <div>
                <div>18 % <?=\Yii::t('order', 'VAT')?> <span class="pull-right"><?=\Yii::t('order', 'Included')?></span></div>
            </div>
            <div>
                <div><?=\Yii::t('order', 'Price')?> <span class="pull-right"><span id="totalPrice"><?=$room_price?></span> GEL</span></div>
            </div>
        </div>
        <p><?=\Yii::t('order', 'Free cancellation before 24h')?></p>
        <p><?=\Yii::t('order', 'Payment at the hotel')?></p>
    </div>
    <div class="col-md-9 form-group">
        <h4><?=\Yii::t('order', 'Enter your details')?></h4>
        <?php $form = ActiveForm::begin(['id' => 'orderForm', 'action' => ['order/finish']]); ?>
            <?=Html::activeHiddenInput($model, 'start_date')?>
            <?=Html::activeHiddenInput($model, 'end_date')?>
            <?=Html::activeHiddenInput($model, 'rooms')?>
            <?=Html::activeHiddenInput($model, 'quantities')?>
            <?=Html::activeHiddenInput($model, 'room_services')?>

            <div class="form-block">
                <h5><span class="text-danger">*</span> <?=\Yii::t('order', 'Required information')?></h5>
                <div class="row">
                    <div class="col-md-3">
                        <?=$form->field($model, 'first_name')->textInput(['class' => 'form-control input-sm'])->error(false)?>
                    </div>
                    <div class="col-md-3">
                        <?=$form->field($model, 'last_name')->textInput(['class' => 'form-control input-sm'])->error(false)?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <?=$form->field($model, 'email')->textInput(['class' => 'form-control input-sm'])->error(false)?>
                    </div>
                    <div class="col-md-3">
                        <?=$form->field($model, 'email_confirm')->textInput(['class' => 'form-control input-sm'])->error(false)?>
                    </div>
                    <div class="col-md-6">
                        <br /><?=\Yii::t('order', 'Confirmation email sent to this address')?>
                    </div>
                </div>
            </div>

            <div class="form-block">
                <div class="row">
                    <div class="col-md-4">
                        <?=$form->field($model, 'airport_transfer_price_id')
                            ->dropDownList(ArrayHelper::map($airportTransferPrices, 'id', 'name'), [
                                'prompt' => \Yii::t('order', 'Select number of passengers'),
                            ])?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <?=$form->field($model, 'parking_reservation')->checkbox()?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <?=\Yii::t('order', 'Only with availability')?>. <?=\Yii::t('order', 'Hotel confirmation mail is needed')?>
                    </div>
                </div>
            </div>

            <h4><?=\Yii::t('order', 'Enter your address')?></h4>
            <div class="form-block">
                <div class="row">
                    <div class="col-md-3">
                        <?=$form->field($model, 'country')->dropDownList(ArrayHelper::map(Countries::find()->all(), 'id', 'country_name'), [
                            'class' => 'form-control input-sm',
                            'prompt' => \Yii::t('order', 'Select country')
                        ])->error(false)?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <?=$form->field($model, 'city')->textInput(['class' => 'form-control input-sm'])->error(false)?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <?=$form->field($model, 'address')->textInput(['class' => 'form-control input-sm'])->error(false)?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <?=$form->field($model, 'zip_code')->textInput(['class' => 'form-control input-sm'])?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <?=$form->field($model, 'mobile')->textInput(['class' => 'form-control input-sm'])->error(false)?>
                    </div>
                </div>
            </div>

            <div class="form-block">
                <div class="row">
                    <div class="col-md-6">
                        <?=$form->field($model, 'comment')->textarea(['rows' => 5])?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <?=$form->field($model, 'arrival_time')->widget(TimePicker::classname(), [
                            'size' => 'xs',
                            'pluginOptions' => [
                                'minuteStep' => 5,
                                'defaultTime' => false,
                                'showInputs' => false,
                                'showMeridian' => false
                            ]
                        ])?>
                    </div>
                </div>
            </div>

            <?=Html::submitButton('Book Now')?>
        <?php ActiveForm::end(); ?>
    </div>
</div>
