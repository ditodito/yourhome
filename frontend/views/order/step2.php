<?php
use frontend\assets\order\Step2Asset;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

Step2Asset::register($this);
?>

<div class="row">
    <div class="col-md-3">f</div>
    <div class="col-md-9">
        <h4>Enter your details</h4>
        <?php $form = ActiveForm::begin([
            'id' => 'orderForm',
            'action' => ['/order/step1']
        ]); ?>
            <?=Html::activeHiddenInput($model, 'start_date')?>
            <?=Html::activeHiddenInput($model, 'end_date')?>
            <?=Html::activeHiddenInput($model, 'room_id')?>
            <?=Html::activeHiddenInput($model, 'quantity')?>

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
                        <?=$form->field($model, 'email')->textInput(['class' => 'form-control input-sm'])?>
                    </div>
                    <div class="col-md-3">
                        <?=$form->field($model, 'email_confirm')->textInput(['class' => 'form-control input-sm'])?>
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
                        <?=$form->field($model, 'country')->textInput(['class' => 'form-control input-sm'])->error(false)?>
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
