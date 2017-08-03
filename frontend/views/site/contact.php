<?php
use frontend\assets\ContactAsset;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

ContactAsset::register($this);

$this->title = 'YourHome :: '.\Yii::t('menu', 'Contacts');
?>

<div class="row">
    <div class="col-md-8">
        <h3>Contact</h3>

        <div class="row">
            <div class="col-md-6">
                <h5>Address:</h5>
                <div>95 Mikheili Tsinamdzghvrishvili Street 0164 Tbilisi Georgia</div>

                <h5 style="margin-top: 120px;">General information:</h5>
                <div>95 Mikheili Tsinamdzghvrishvili Street 0164 Tbilisi</div>
                <div>95 Mikheili Tsinamdzghvrishvili Street 0164 Tbilisi</div>
                <div>95 Mikheili Tsinamdzghvrishvili Street 0164 Tbilisi</div>
                <div>95 Mikheili Tsinamdzghvrishvili Street 0164 Tbilisi</div>
            </div>
            <div class="col-md-6">
                <h5>Standart</h5>
                <p>
                    Tel / Fax:<br />
                    (+995 32) 221-00-00 (Georgian)
                </p>
                <p>
                    Mail:<br />
                    yourhome@gmail.com
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h5 style="margin-top: 120px;">Access map</h5>
                <div id="map">map</div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <!--<div id="banner"></div>-->
        <div class="side-info">
            <h5>Our additional services and facilities</h5>
            <div>- Airport transfer</div>
            <div>- 25-hour front desc</div>
            <?=Html::a('more...', ['/site/services'], ['class' => 'more'])?>
        </div>

        <div class="side-info">
            <h5 style="border-bottom: none; margin-top: 15px;">Our tours</h5>
            <div>
                <?=Html::img(\Yii::getAlias('@web/img/tours.png'), ['height' => 30, 'alt' => 'Tours'])?>
                Discover georgia with as.<br /> We organize different tours<br />
                <?=Html::a('more...', ['/site/tours'], ['class' => 'more'])?>
            </div>
        </div>
    </div>
</div>
