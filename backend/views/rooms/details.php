<?php
use dosamigos\tinymce\TinyMce;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;

$this->title = 'YourHomeHotel :: Admin Page';
?>

<div class="row">
    <div class="col-md-1 form-group">
        <?=Html::a('&laquo; '.\Yii::t('main', 'Back'), ['rooms/'], ['class' => 'btn btn-primary'])?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?php $form = ActiveForm::begin([
            'action' => ['rooms/save'],
            'options' => [
                'enctype' => 'multipart/form-data'
            ]
        ]); ?>
        <?=Html::activeHiddenInput($model, 'id')?>
        <?=$form->field($model, 'name_us')->error(false)?>
        <?=$form->field($model, 'name_ge')->error(false)?>
        <?=$form->field($model, 'name_ru')->error(false)?>
        <?=$form->field($model, 'description_us')->textarea(['rows' => 5])->error(false)?>
        <?=$form->field($model, 'description_ge')->textarea(['rows' => 5])->error(false)?>
        <?=$form->field($model, 'description_ru')->textarea(['rows' => 5])->error(false)?>
        <div class="row">
            <div class="col-md-4">
                <?=$form->field($model, 'quantity')->textInput(['type' => 'number', 'min' => 1])->error(false)?>
            </div>
            <div class="col-md-4">
                <?=$form->field($model, 'capacity')->textInput(['type' => 'number', 'min' => 1])->error(false)?>
            </div>
            <div class="col-md-4">
                <?=$form->field($model, 'price')->textInput(['type' => 'number', 'min' => 1])->error(false)?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?=$form->field($model, 'is_hostel')->checkbox()?>
                <?=$form->field($model, 'free_wifi')->checkbox()?>
                <?=$form->field($model, 'tv')->checkbox()?>
                <?=$form->field($model, 'air_conditioning')->checkbox()?>
                <?=$form->field($model, 'shared_bathroom')->checkbox()?>
                <?=$form->field($model, 'private_bathroom')->checkbox()?>
                <?=$form->field($model, 'hairdrayer')->checkbox()?>
                <?=$form->field($model, 'heating')->checkbox()?>
                <?=$form->field($model, 'linen')->checkbox()?>
                <?=$form->field($model, 'shared_kitchenette')->checkbox()?>
                <?=$form->field($model, 'private_kitchenette')->checkbox()?>
                <?=$form->field($model, 'non_smoking')->checkbox()?>
                <?=$form->field($model, 'toiletries')->checkbox()?>
                <?=$form->field($model, 'towels')->checkbox()?>
                <?=$form->field($model, 'slippers')->checkbox()?>
            </div>
            <div class="col-md-4">
                <?=Html::img('@frontend_web/img/rooms/'.$model->image, ['class' => 'img-responsive img-thumbnail'])?>
                <?=$form->field($model, 'image')->fileInput()?>
            </div>
        </div>
        <?=Html::submitButton('შენახვა', ['class' => 'btn btn-primary'])?>
        <?php ActiveForm::end(); ?>
    </div>
</div>