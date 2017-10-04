<?php
use common\api\actions\RoomsActions;
use frontend\models\OrderForm;
//use kartik\datetime\DateTimePicker;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

$order_form = new OrderForm();

/*DateTimePicker::widget([
    'name' => 'check_in',
    'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
    'size' => 'sm',
    'pickerButton' => [
        'title' => null,
        'style' => 'background-color: #fff; border: none; border-radius: 0;'
    ],
    'removeButton' => false,
    'options' => [
        'style' => 'outline: none; border: none; border-radius: 0;'
    ],
    'convertFormat' => true,
    'pluginOptions' => [
        //'startDate' => date('m/d/Y', time()),
        'autoclose' => true,
        'format' => 'mm/dd/yyyy',
        'maxView' => 2,
        'minView' => 2,
    ]
])
 DateTimePicker::widget([
        'name' => 'check_out',
        'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
        'size' => 'sm',
        'pickerButton' => [
            'title' => null,
            'style' => 'background-color: #fff; border: none; border-radius: 0;'
        ],
        'removeButton' => false,
        'options' => [
            'style' => 'outline:none; border: none; border-radius: 0;'
        ],
        'convertFormat' => true,
        'pluginOptions' => [
            //'startDate' => date('m/d/Y', time()),
            'autoclose' => true,
            'format' => 'mm/dd/yyyy',
            'maxView' => 2,
            'minView' => 2,
        ]
    ])
 */
?>
<!--
<div class="reservation-input" style="width: 200px;">
    <label class="control-label"><?=\Yii::t('rooms', 'Room')?></label>
    <select class="form-control input-sm" style="border: 0; border-radius: 0;">
        <?php foreach(RoomsActions::getRoomsTitle() as $room): ?>
            <option value="<?=$room->id?>"><?=$room->name?></option>
        <?php endforeach; ?>
    </select>
</div>
<div class="reservation-input">
    <label class="control-label">&nbsp;</label>
    <input type="submit" style="background-color: #8b7d72; padding: 5px 10px; color: #fff;" />Book Now</input>
</div>
-->

<header class="header">
    <div class="container">
        <?=Html::img('@web/img/logo.png', ['class' => 'logo', 'alt' => 'YourHome'])?>

        <div class="nav-wrapper">
            <nav class="nav">
                <?=Html::a(\Yii::t('menu', 'Home'), ['/site'])?>
                <?=Html::a(\Yii::t('menu', 'Rooms & Rates'), ['/site/rooms'])?>
                <?=Html::a(\Yii::t('menu', 'Service'), ['/site/services'])?>
                <?=Html::a(\Yii::t('menu', 'Photo Gallery'), ['/site/gallery'])?>
                <?=Html::a(\Yii::t('menu', 'Contacts'), ['/site/contact'])?>
                <?=Html::a(\Yii::t('menu', 'Our Tours'), ['/tours'], ['style' =>'float: right;'])?>
            </nav>

            <div id="languageWrapper">
                <?=Html::img(\Yii::getAlias('@web/img/flag_'.\Yii::$app->language.'.png'), ['height' => 16])?>
                <select name="languages" id="languages">
                    <option value="en-US" data-url="<?=Url::to(['site/change-language', 'lang' => 'en-US'])?>" <?php if (\Yii::$app->language == 'en-US') echo 'selected'; ?>>Eng</option>
                    <option value="ka-GE" data-url="<?=Url::to(['site/change-language', 'lang' => 'ka-GE'])?>" <?php if (\Yii::$app->language == 'ka-GE') echo 'selected'; ?>>Geo</option>
                    <option value="ru-RU" data-url="<?=Url::to(['site/change-language', 'lang' => 'ru-RU'])?>" <?php if (\Yii::$app->language == 'ru-RU') echo 'selected'; ?>>Rus</option>
                </select>
            </div>
        </div>
    </div>

    <?php if (\Yii::$app->controller->id === 'site' && \Yii::$app->controller->action->id === 'index'): ?>
        <div class="header-reservation">
            <div><?=\Yii::t('order', 'Online reservation')?></div>
            <div>
                <div></div>
                <div>
                    <?php $form = ActiveForm::begin([
                        'action' => ['/order/step1']
                    ]); ?>
                        <div class="reservation-input">
                            <label class="control-label"><?=\Yii::t('order', 'Check-in')?></label>
                            <?=Html::activeInput('text', $order_form, 'start_date', ['class' => 'form-control input-sm', 'style' => 'border: none; border-radius: 0;'])?>
                            <?php //$form->field($order_form, 'start_date')->label(false)->error(false)?>
                        </div>
                        <div class="reservation-input">
                            <label class="control-label"><?=\Yii::t('order', 'Check-out')?></label>
                            <?=Html::activeInput('text', $order_form, 'end_date', ['class' => 'form-control input-sm', 'style' => 'border: none; border-radius: 0;'])?>
                            <?php //$form->field($order_form, 'end_date')->label(false)->error(false); ?>
                        </div>
                        <div class="reservation-input" style="width: 200px;">
                            <label class="control-label"><?=\Yii::t('rooms', 'Room')?></label>
                            <?=Html::activeDropDownList($order_form, 'room_id', ArrayHelper::map(RoomsActions::getRoomsTitle(), 'id', 'name'), ['class' => 'form-control input-sm', 'style' => 'border: none; border-radius: 0;'])?>
                            <?php //$form->field($order_form, 'room_id')->dropDownList(ArrayHelper::map(RoomsActions::getRoomsTitle(), 'id', 'name'))->label(false)->error(false)?>
                        </div>
                        <div class="reservation-input">
                            <label class="control-label">&nbsp;</label>
                            <?=Html::submitButton('Book Now', ['style' => 'color: #fff; display: block; outline: none; border: none; background-color: #8b7d72; padding: 5px 10px;'])?>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="header-img"></div>
</header>