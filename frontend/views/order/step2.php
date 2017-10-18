<?php
use common\api\models\database\Countries;
use frontend\assets\order\Step2Asset;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;

Step2Asset::register($this);
?>

<div class="row">
    <div class="col-md-3">
        <div class="booking-header"><?=\Yii::t('order', 'Your booking details')?></div>
        <div class="booking-details">
            <div>18 % <?=\Yii::t('order', 'VAT')?> <span class="pull-right"><?=\Yii::t('order', 'Included')?></span></div>
            <div><?=\Yii::t('order', 'Free cancellation before 24h')?> *</div>
            <div><?=\Yii::t('order', 'Payment at the hotel')?></div>
        </div>
    </div>


    <div class="col-md-9">
        <h4><?=\Yii::t('order', 'Enter your details')?></h4>
        <?php $form = ActiveForm::begin([
            'id' => 'orderForm',
            'action' => ['/order/finish']
        ]); ?>
            <?=Html::activeHiddenInput($model, 'start_date')?>
            <?=Html::activeHiddenInput($model, 'end_date')?>
            <?=Html::activeHiddenInput($model, 'room_ids')?>
            <?=Html::activeHiddenInput($model, 'capacities')?>

            <div style="background-color: #aed786; padding: 10px 15px;">
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
