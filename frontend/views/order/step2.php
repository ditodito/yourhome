<?php
use common\api\models\database\Countries;
use frontend\assets\order\Step2Asset;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;

Step2Asset::register($this);
?>

<div class="row">
    <div class="col-md-3 form-group">
        <div class="booking-header"><?=\Yii::t('order', 'Your booking details')?></div>
        <div class="booking-details">
            <div>
                <div><strong><?=\Yii::t('order', 'Check-in')?></strong></div>
                <div>
                    <?=\Yii::t('day', date('l', $start_date))?>, <?=\Yii::t('month', date('F', $start_date))?> <?=date('d', $start_date)?>, <?=date('Y', $start_date)?>
                    <?=\Yii::t('order', 'From 14:00 (2:00 PM)')?>
                </div>
            </div>
            <div>
                <div><strong><?=\Yii::t('order', 'Check-out')?></strong></div>
                <div>
                    <?=\Yii::t('day', date('l', $end_date))?>, <?=\Yii::t('month', date('F', $end_date))?> <?=date('d', $end_date)?>, <?=date('Y', $end_date)?>
                    <?=\Yii::t('order', 'Until 12:00 (noon)')?>
                </div>
            </div>
            <div>
                <div><strong>Total length of stay</strong></div>
                <div><?=$days?> <?=\Yii::t('order', 'night')?></div>
            </div>
        </div>

        <!--
        <div class="booking-extra" style="margin-top: 15px;">
            <?php print_r($model->room_ids); ?>
        </div>
        -->

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
        <p style="margin-top: 10px;"><?=\Yii::t('order', 'Free cancellation before 24h')?></p>
        <p><?=\Yii::t('order', 'Payment at the hotel')?></p>
    </div>


    <div class="col-md-9 form-group">
        <h4><?=\Yii::t('order', 'Enter your details')?></h4>
        <?php $form = ActiveForm::begin([
            'id' => 'orderForm',
            'action' => ['/order/finish']
        ]); ?>
            <?=Html::activeHiddenInput($model, 'start_date')?>
            <?=Html::activeHiddenInput($model, 'end_date')?>
            <?=Html::activeHiddenInput($model, 'room_ids')?>
            <?=Html::activeHiddenInput($model, 'capacities')?>

            <div style="background-color: #aed786; padding: 10px 15px; margin-bottom: 15px;">
                <h5><span style="color: red;">*</span> Required information</h5>
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
                        <br/>
                        Confirmation email sent to this address
                    </div>
                </div>
            </div>

            <div style="background-color: #aed786; padding: 10px 15px;">
                <div class="row">
                    <div class="col-md-8">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="airportTransfer" />
                                <?=\Yii::t('services', 'Airport transfer')?>
                            </label>
                        </div>
                        <div>Only with availability. Hotel confirmation mail is needed</div>
                    </div>

                    <div class="col-md-4">
                        <?=$form->field($model, 'airport_transfer_price_id')
                            ->dropDownList(ArrayHelper::map($airportTransferPrices, 'id', 'name'), [
                                'prompt' => \Yii::t('order', 'Select number of passengers'),
                                'disabled' => true
                            ])
                            ->label(false)?>
                    </div>
                </div>
                <?=$form->field($model, 'parking_reservation')->checkbox()?>
                <?=$form->field($model, 'breakfast')->checkbox()?>
            </div>

            <h4>Enter your address</h4>
            <div style="background-color: #aed786; padding: 10px 15px; margin-bottom: 15px;">
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
                    <div class="col-md-2">
                        <?=$form->field($model, 'zip_code')->textInput(['class' => 'form-control input-sm'])?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <?=$form->field($model, 'mobile')->textInput(['class' => 'form-control input-sm'])->error(false)?>
                    </div>
                </div>
            </div>

            <div style="background-color: #aed786; padding: 10px 15px;">
                <div class="row">
                    <div class="col-md-6">
                        <?=$form->field($model, 'comment')->textarea(['rows' => 5])->error(false)?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <?=$form->field($model, 'arrival_time')->textInput(['class' => 'form-control input-sm'])?>
                    </div>
                </div>
            </div>

            <?=Html::submitButton('Book Now')?>

        <?php ActiveForm::end(); ?>
    </div>
</div>
