<?php
use yii\helpers\Html;

$cont = \Yii::$app->controller->id;
$act = \Yii::$app->controller->action->id;
?>

<div class="side-info">
    <?=Html::img(\Yii::getAlias('@web/img/side_banner.jpg'), ['class' => 'img-responsive', 'alt' => 'Banner'])?>
</div>

<?php if (($cont == 'site' && $act == 'rooms') || ($cont == 'site' && $act == 'services') || ($cont == 'site' && $act == 'gallery')): ?>
    <div class="side-info">
        <h5><?=\Yii::t('contacts', 'Address')?>:</h5>
        <div><?=\Yii::t('contacts', '{0} Mikheili Tsinamdzghvrishvili Street, {1} Tbilisi, Georgia', ['95', '0164'])?></div>
    </div>

    <div class="side-info">
        <h5><?=\Yii::t('contacts', 'Metro')?>:</h5>
        <div>
            <?=\Yii::t('contacts', 'Line {0}', ['I'])?>, <?=\Yii::t('contacts', 'Station Marjanishvili')?><br />
            <?=\Yii::t('contacts', 'Open hours - {0} (6am-12am)', ['06:00-24:00'])?>
        </div>
    </div>

    <div class="side-info">
        <h5><?=\Yii::t('contacts', 'Bus')?>:</h5>
        <div>N122, <?=\Yii::t('contacts', 'Station Tsinamdzghvrishvili')?></div>
    </div>
<?php endif; ?>

<div class="side-info" style="background-color: #c0c0c0; padding: 5px 10px 10px;">
    <h5><?=\Yii::t('order', 'Check-in')?>:</h5>
    <div><?=\Yii::t('order', 'From 14:00 (2:00 PM)')?></div>
    <h5><?=\Yii::t('order', 'Check-out')?>:</h5>
    <div><?=\Yii::t('order', 'Until 12:00 (noon)')?></div>
</div>

<?php if (($cont == 'site' && $act == 'rooms') || ($cont == 'site' && $act == 'services') || ($cont == 'site' && $act == 'gallery')): ?>
    <div class="side-info">
        <h5><?=\Yii::t('menu', 'Contacts')?>:</h5>
        <div>
            <?=\Yii::t('contacts', 'Tel')?> / <?=\Yii::t('contacts', 'Fax')?>: (+995 32) 221 00 00<br />
            <?=\Yii::t('contacts', 'Cell')?>: (+995) 558 48 28 88 (<?=\Yii::t('contacts', 'Chief manager')?>)<br />
            <?=\Yii::t('contacts', 'E-mail')?>: <?=\Yii::$app->params['infoEmail']?>
        </div>
    </div>
<?php endif; ?>

<?php if (($cont == 'site' && $act == 'rooms') || ($cont == 'site' && $act == 'gallery') || ($cont == 'site' && $act == 'contact')): ?>
    <div class="side-info">
        <h5><?=\Yii::t('services', 'Our additional services and facilities')?></h5>
        <div>
            <!-- - <?=\Yii::t('main', 'Free')?> WiFi<br /> -->
            - <?=\Yii::t('services', 'Free private parking')?> (<?=\Yii::t('contacts', 'upon request')?>)<br />
            - <?=\Yii::t('services', 'Luggage storage')?><br />
            - <?=\Yii::t('services', 'Airport transfer')?> (<?=Html::a(\Yii::t('contacts', 'upon request'), ['site/services'])?>)<br />
            - <?=\Yii::t('services', '24-hour front desk')?><br />
            <!-- - <?=\Yii::t('rooms', 'Toiletries')?><br />
            - <?=\Yii::t('rooms', 'Towels')?><br />
            - <?=\Yii::t('main', 'Kitchenette')?> -->
        </div>
        <?=Html::a(\Yii::t('main', 'More').'...', ['site/services'], ['class' => 'more'])?>
    </div>

    <div class="side-info">
        <h5><?=\Yii::t('menu', 'Our Tours')?></h5>
        <div>
            <?=Html::img(\Yii::getAlias('@web/img/our_tours.jpg'), [
                'class' => 'img-rounded img-responsive',
                'alt' => \Yii::t('menu', 'Our Tours')
            ])?>
            <?=\Yii::t('tours', 'Discover Georgia with us, we organize the different excursions')?>
        </div>
        <?=Html::a(\Yii::t('main', 'More').'...', ['tours/'], ['class' => 'more'])?>
    </div>
<?php endif; ?>
