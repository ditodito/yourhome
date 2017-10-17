<?php
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\overlays\Marker;
use frontend\assets\ContactAsset;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

ContactAsset::register($this);

$this->title = 'YourHomeHotel :: '.\Yii::t('menu', 'Contacts');
?>

<div class="row">
    <div class="col-md-3 form-group">
        <div class="side-banner">
            <?=Html::img(\Yii::getAlias('@web/img/side_banner.jpg'), ['alt' => 'Banner'])?>
        </div>
        <div class="side-info" style="background-color: #c0c0c0; padding: 5px 10px 10px 10px;">
            <h5><?=\Yii::t('order', 'Check-in')?>:</h5>
            <div><?=\Yii::t('order', 'From 14:00 (2:00 PM)')?></div>
            <h5><?=\Yii::t('order', 'Check-out')?>:</h5>
            <div><?=\Yii::t('order', 'Until 12:00 (noon)')?></div>
        </div>
        <div class="side-info">
            <h5><?=\Yii::t('services', 'Our additional services and facilities')?></h5>
            <div>- <?=\Yii::t('main', 'Free')?> WiFi</div>
            <div>- <?=\Yii::t('services', 'Free private parking')?></div>
            <div>- <?=\Yii::t('services', 'Luggage storage')?></div>
            <div>- <?=\Yii::t('services', 'Airport transfer')?> (<?=Html::a(\Yii::t('contacts', 'upon request'), ['/site/services'])?>)</div>
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
    </div>
    <div class="col-md-9 form-group">
        <h3 class="page-title"><?=\Yii::t('menu', 'Contacts')?></h3>
        <div class="row">
            <div class="col-md-6 form-group">
                <div class="info-wrapper">
                    <h5 class="info-title"><?=\Yii::t('contacts', 'Address')?>:</h5>
                    <div><?=\Yii::t('contacts', '{0} Mikheili Tsinamdzghvrishvili Street, {1} Tbilisi, Georgia', ['95', '0164'])?></div>
                </div>
                <div class="info-wrapper">
                    <h5 class="info-title"><?=\Yii::t('contacts', 'Metro')?>:</h5>
                    <div>
                        <?=\Yii::t('contacts', 'Line {0}', ['I'])?>, <?=\Yii::t('contacts', 'Station Marjanishvili')?>
                        <br /><?=\Yii::t('contacts', 'Open hours - {0} (6am-12am)', ['06:00-24:00'])?>
                    </div>
                </div>
                <div class="info-wrapper">
                    <h5 class="info-title"><?=\Yii::t('contacts', 'Bus')?>:</h5>
                    <div>N122, <?=\Yii::t('contacts', 'Station Tsinamdzghvrishvili')?></div>
                </div>
                <div class="info-wrapper">
                    <h5 class="info-title"><?=\Yii::t('contacts', 'General information')?>:</h5>
                    <div><?=\Yii::t('contacts', 'Tel')?> / <?=\Yii::t('contacts', 'Fax')?>: (+995 32) 221 00 00</div>
                    <div><?=\Yii::t('contacts', 'Cell')?>: (+995) 558 48 28 88 (<?=\Yii::t('contacts', 'Manager')?>)</div>
                    <div><?=\Yii::t('contacts', 'E-mail')?>: yourhometbilisi@yahoo.com</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group">
                <h5 class="info-title"><?=\Yii::t('contacts', 'Access Map')?></h5>
                <?php
                $coord = new LatLng(['lat' => 41.712990, 'lng' => 44.798526]);
                $map = new Map([
                    'width' => '100%',
                    'height' => '400',
                    'center' => $coord,
                    'zoom' => 17
                ]);
                $marker = new Marker([
                    'position' => $coord,
                    'title' => 'YourHomeHotel.Ge'
                ]);
                $map->addOverlay($marker);
                echo $map->display();
                ?>
            </div>
        </div>
    </div>
</div>
