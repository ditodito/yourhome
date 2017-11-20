<?php
use dosamigos\tinymce\TinyMce;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;

$this->title = 'YourHomeHotel :: Admin Page';
?>

<div class="row">
    <div class="col-md-1 form-group">
        <?=Html::a('&laquo; '.\Yii::t('main', 'Back'), ['tours/'], ['class' => 'btn btn-primary'])?>
    </div>
</div>
<div class="row">
    <div class="col-md-12 form-group">
        <?php $form = ActiveForm::begin([
            'action' => ['tours/save'],
            'options' => [
                'enctype' => 'multipart/form-data'
            ]
        ]); ?>
        <?=Html::activeHiddenInput($model, 'id')?>
        <?=$form->field($model, 'duration_id')->dropDownList(ArrayHelper::map($durations, 'id', 'name'))->error(false)?>
        <?=$form->field($model, 'title_us')->error(false)?>
        <?=$form->field($model, 'title_ge')->error(false)?>
        <?=$form->field($model, 'title_ru')->error(false)?>
        <?=$form->field($model, 'text_us')->widget(TinyMce::className(), [
            'options' => ['rows' => 10],
            'language' => 'en',
            'clientOptions' => [
                'plugins' => [
                    "advlist autolink lists link charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste"
                ],
                'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
            ]
        ])?>
        <?=$form->field($model, 'text_ge')->widget(TinyMce::className(), [
            'options' => ['rows' => 10],
            'language' => 'en',
            'clientOptions' => [
                'plugins' => [
                    "advlist autolink lists link charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste"
                ],
                'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
            ]
        ])?>
        <?=$form->field($model, 'text_ru')->widget(TinyMce::className(), [
            'options' => ['rows' => 10],
            'language' => 'en',
            'clientOptions' => [
                'plugins' => [
                    "advlist autolink lists link charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste"
                ],
                'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
            ]
        ])?>
        <p style="width: 30%;">
            <?=Html::img('@frontend_web/img/tours/'.$model->image, ['class' => 'img-responsive img-thumbnail'])?>
        </p>
        <?=$form->field($model, 'image')->fileInput()?>
        <?=Html::submitButton('შენახვა', ['class' => 'btn btn-primary'])?>
        <?php ActiveForm::end(); ?>
    </div>
</div>