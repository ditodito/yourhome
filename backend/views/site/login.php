<?php
use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'YourHomeHotel :: Login';
?>

<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <h3>სიტემაში შესვლა</h3>
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <?=$form->field($model, 'username')->textInput(['autofocus' => true])->error(false)?>
            <?=$form->field($model, 'password')->passwordInput()->error(false)?>
            <?=$form->field($model, 'rememberMe')->checkbox()?>
            <?= Html::submitButton('შესვლა', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>