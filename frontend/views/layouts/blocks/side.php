<?php
    use yii\helpers\Html;
?>
<div class="side-banner">
    <?=Html::img(\Yii::getAlias('@web/img/side_banner.jpg'), ['alt' => 'Banner'])?>
</div>

<div class="side-info">
    <h5><?=\Yii::t('contacts', 'Address')?>:</h5>
    <div><?=\Yii::t('contacts', '{0} Mikheili Tsinamdzghvrishvili Street, {1} Tbilisi, Georgia', ['95', '0164'])?></div>
</div>

<div class="side-info">
    <h5><?=\Yii::t('contacts', 'Metro')?>:</h5>
    <div><?=\Yii::t('contacts', 'Line I, Station Marjanishvili. Open hours - 06:00-24:00 (6am-12am)')?></div>
</div>

<div class="side-info">
    <h5><?=\Yii::t('contacts', 'Bus')?>:</h5>
    <div>N122, <?=\Yii::t('contacts', 'Station Tsinamdzghvrishvili')?></div>
</div>

<div class="side-info" style="background-color: #c0c0c0; padding: 5px 10px 10px 10px;">
    <h5><?=\Yii::t('order', 'Check-in')?>:</h5>
    <div><?=\Yii::t('order', 'From 14:00 (2:00 PM)')?></div>
    <h5><?=\Yii::t('order', 'Check-out')?>:</h5>
    <div><?=\Yii::t('order', 'Until 12:00 (noon)')?></div>
</div>

<div class="side-info">
    <h5><?=\Yii::t('menu', 'Contacts')?>:</h5>
    <div><?=\Yii::t('contacts', 'Tel')?> / <?=\Yii::t('contacts', 'Fax')?>:</div>
    <div><?=\Yii::t('contacts', 'Manager')?>: (+995) 558 58 48 08</div>
    <div><?=\Yii::t('contacts', 'Standard')?>: (+995 32) 221 00 00</div>
</div>

<div class="side-info">
    <h5><?=\Yii::t('contacts', 'E-mail')?>:</h5>
    <div>yourhometbilisi@yahoo.com</div>
</div>

<div class="side-info">
    <h5><?=\Yii::t('services', 'Our additional services and facilities')?></h5>
    <div>- <?=\Yii::t('main', 'Free')?> WiFi</div>
    <div>- <?=\Yii::t('services', 'Free private parking')?></div>
    <div>- <?=\Yii::t('services', 'Luggage storage')?></div>
    <div>- <?=\Yii::t('services', 'Airport transfer(upon request)')?></div>
    <div>- <?=\Yii::t('services', '24-hour front desk')?></div>
    <div>- <?=\Yii::t('rooms', 'Toiletries')?></div>
    <div>- <?=\Yii::t('rooms', 'Towels')?></div>
    <div>- <?=\Yii::t('main', 'Kitchenette')?></div>
    <?=Html::a(\Yii::t('main', 'More').'...', ['/site/services'], ['class' => 'more'])?>
</div>

<div class="side-info">
    <h5><?=\Yii::t('menu', 'Our Tours')?></h5>
    <div>
        <?=Html::img(\Yii::getAlias('@web/img/tours.png'), ['height' => 30, 'alt' => \Yii::t('menu', 'Our Tours')])?>
        <?=\Yii::t('tours', 'Discover Georgia with us, we organize the different excursions')?>
    </div>
    <?=Html::a(\Yii::t('main', 'More').'...', ['/tours/'], ['class' => 'more'])?>
</div>