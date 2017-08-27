<?php
use frontend\assets\IndexAsset;
use yii\bootstrap\Html;

IndexAsset::register($this);

$this->title = 'YourHome :: '.\Yii::t('menu', 'Home');
?>

<div class="row" style="margin-top: 15px;">
    <div class="col-md-4">
        <h4 class="title"><?=\Yii::t('contacts', 'Access Map')?></h4>
        <div id="map">map</div>

        <div class="contact-info">
            <h4 class="title"><?=\Yii::t('contacts', 'Address')?>:</h4>
            <div><?=\Yii::t('contacts', '{0} Mikheili Tsinamdzghvrishvili Street, {1} Tbilisi, Georgia', [95, 0164])?></div>

            <h4 class="title"><?=\Yii::t('contacts', 'Tel')?>:</h4>
            <div>(+995 55) 58 48 08</div>

            <h4 class="title"><?=\Yii::t('contacts', 'E-mail')?>:</h4>
            <div>yourhometbilisi@yahoo.com</div>
        </div>
    </div>
    <div class="col-md-5 about">
        <h4 class="title"><?=\Yii::t('main', 'About Hotel')?></h4>

        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
            dolore magna aliqua.</p>

        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
            ex ea commodo consequat.</p>

        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
            dolore magna aliqua.</p>

        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
            ex ea commodo consequat.</p>
    </div>
    <div class="col-md-3">
        <h4 class="title"><?=\Yii::t('main', 'Facilities')?></h4>
        <div><?=\Yii::t('main', 'Free')?> WiFi</div>
        <div><?=\Yii::t('main', 'Free private parking')?></div>
        <div><?=\Yii::t('main', '24-hour front desk')?></div>
        <div><?=\Yii::t('main', 'Luggage storage')?></div>
        <div><?=\Yii::t('main', 'Kitchenette')?></div>
        <div><?=\Yii::t('main', 'Airport Transfer(upon request)')?></div>
        <div class="more"><?=Html::a(\Yii::t('main', 'more').'...', ['/more'])?></div>

        <h4 class="title" style="margin-top: 20px;"><?=\Yii::t('menu', 'Our Tours')?></h4>
        <div><?=\Yii::t('tours', 'Discover Georgia with us, we organize the different excursions')?></div>
        <div class="more"><?=Html::a(\Yii::t('main', 'more').'...', ['/more'])?></div>
    </div>
</div>
