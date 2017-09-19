<?php
use frontend\assets\ContactAsset;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

ContactAsset::register($this);

$this->title = 'YourHomeHotel :: '.\Yii::t('menu', 'Contacts');
?>

<h3 class="page-title"><?=\Yii::t('menu', 'Contacts')?></h3>
<div class="row">
    <div class="col-md-6">
        <div class="info-wrapper">
            <h5 class="info-title"><?=\Yii::t('contacts', 'Address')?>:</h5>
            <div><?=\Yii::t('contacts', '{0} Mikheili Tsinamdzghvrishvili Street, {1} Tbilisi, Georgia', [95, 0164])?></div>
        </div>
        <div class="info-wrapper">
            <h5 class="info-title"><?=\Yii::t('contacts', 'Metro')?>:</h5>
            <div><?=\Yii::t('contacts', 'Line I, Station Marjanishvili. Open hours - 06:00-24:00 (6am-12am)')?></div>
        </div>
        <div class="info-wrapper">
            <h5 class="info-title"><?=\Yii::t('contacts', 'Bus')?>:</h5>
            <div>N122, <?=\Yii::t('contacts', 'Station Tsinamdzghvrishvili')?></div>
        </div>
        <div class="info-wrapper">
            <h5 class="info-title"><?=\Yii::t('contacts', 'General information')?>:</h5>
            <div>(+995 5) 558 48 28 88 (English)</div>
            <div>(+995 5) 577 53 72 12 (Russian/Hebrew)</div>
            <div>(+995 5) 577 54 75 75 (German)</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="info-wrapper">
            <h5 class="info-title">Standard</h5>
            <p>
                <?=\Yii::t('contacts', 'Tel')?> / <?=\Yii::t('contacts', 'Fax')?>:<br />
                (+995 32) 221-00-00 (Georgian)
            </p>
            <p>
                <?=\Yii::t('contacts', 'E-mail')?>:<br />
                yourhome@gmail.com
            </p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h5 class="info-title" style="margin-top: 50px;"><?=\Yii::t('contacts', 'Access Map')?></h5>
        <div id="map"></div>
    </div>
</div>
