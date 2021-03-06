<?php
use frontend\models\OrderForm;
use kartik\date\DatePicker;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$order_form = new OrderForm();

$controller = \Yii::$app->controller->id;
$action = \Yii::$app->controller->action->id;
?>

<header class="header">
    <div class="container">
        <?=Html::a(Html::img('@web/img/logo.png', ['class' => 'logo', 'alt' => 'YourHome']), ['/'])?>

        <div class="nav-wrapper">
            <nav class="nav">
                <?=Html::a(\Yii::t('menu', 'Home'), ['/site'], ['class' => ($controller == 'site' && $action == 'index') ? 'active' : ''])?>
                <?=Html::a(\Yii::t('menu', 'Rooms & Rates'), ['/site/rooms'], ['class' => ($controller == 'site' && $action == 'rooms') ? 'active' : ''])?>
                <?=Html::a(\Yii::t('menu', 'Service'), ['/site/services'], ['class' => ($controller == 'site' && $action == 'services') ? 'active' : ''])?>
                <?=Html::a(\Yii::t('menu', 'Photo Gallery'), ['/site/gallery'], ['class' => ($controller == 'site' && $action == 'gallery') ? 'active' : ''])?>
                <?=Html::a(\Yii::t('menu', 'Contacts'), ['/site/contact'], ['class' => ($controller == 'site' && $action == 'contact') ? 'active' : ''])?>
                <?=Html::a(\Yii::t('menu', 'Our Tours'), ['/tours'], ['class' => ($controller == 'tours') ? 'active' : '', 'style' =>'float: right;'])?>
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

        <?php if ($controller == 'site' && $action == 'index'): ?>
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
                            <?=$form->field($order_form, 'start_date')->widget(DatePicker::classname(), [
                                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                'size' => 'sm',
                                'pickerButton' => [
                                    'title' => false,
                                    'style' => 'background-color: #fff; border: none; border-radius: 0;'
                                ],
                                'removeButton' => false,
                                'options' => [
                                    'style' => 'outline: none; border: none; border-radius: 0;',
                                    'value' => date('m/d/Y', time()),
                                ],
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'format' => 'mm/dd/yyyy',
                                    'startDate' => date('m/d/Y', time()),
                                ],
                                'pluginEvents' => [
                                    "clearDate" => "function(e) {
                                        $('#orderform-end_date').kvDatepicker('clearDates');
                                    }",
                                    "changeDate" => "function(e) {
                                        $('#orderform-end_date').kvDatepicker('clearDates');
                                        var start_day = new Date($('#orderform-start_date').val());
                                        var next_day = new Date(start_day.getTime() + 86400000);
                                        $('#orderform-end_date').kvDatepicker('setStartDate', next_day.toLocaleDateString());
                                    }"
                                ]
                            ])->label(false)->error(false)?>
                        </div>
                        <div class="reservation-input">
                            <label class="control-label"><?=\Yii::t('order', 'Check-out')?></label>
                            <?=$form->field($order_form, 'end_date')->widget(DatePicker::classname(), [
                                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                'size' => 'sm',
                                'pickerButton' => [
                                    'title' => false,
                                    'style' => 'background-color: #fff; border: none; border-radius: 0;'
                                ],
                                'removeButton' => false,
                                'options' => [
                                    'style' => 'outline: none; border: none; border-radius: 0;',
                                    'value' => date('m/d/Y', strtotime('+1 days')),
                                ],
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'format' => 'mm/dd/yyyy',
                                    'startDate' => date('m/d/Y', strtotime('+1 days')),
                                ]
                            ])->label(false)->error(false)?>
                        </div>
                        <div class="reservation-input">
                            <label class="control-label">&nbsp;</label>
                            <?=Html::submitButton(\Yii::t('main', 'Search'), ['style' => 'color: #fff; display: block; outline: none; border: none; background-color: #8b7d72; padding: 5px 20px;'])?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!($controller === 'site' && $action === 'gallery')): ?>
            <?php $header_image = isset($this->params['header_image']) ? $this->params['header_image'] : 'header.jpg'; ?>
            <div class="header-img" style="background: url('<?=\Yii::getAlias('@web/img/'.$header_image)?>') center no-repeat;"></div>
        <?php else: ?>
            <div style="color: #fff; text-align: center; background-color: #8b7d72; padding: 15px; margin-top: 20px;">
                <h4><?=\Yii::t('gallery', 'Gallery hotel "Your Home"')?></h4>
            </div>
        <?php endif; ?>
    </div>
</header>