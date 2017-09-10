<?php
use frontend\assets\ContactAsset;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

ContactAsset::register($this);

$this->title = 'YourHome :: '.\Yii::t('menu', 'Contacts');
?>

<div class="row">
    <h3 class="contact-title">Contact</h3>

    <div class="col-md-6">
        <h5 class="info-title">Address:</h5>
        <div>95 Mikheili Tsinamdzghvrishvili Street 0164 Tbilisi Georgia</div>

        <h5 class="info-title" style="margin-top: 80px;">General information:</h5>
        <div>95 Mikheili Tsinamdzghvrishvili Street 0164 Tbilisi</div>
        <div>95 Mikheili Tsinamdzghvrishvili Street 0164 Tbilisi</div>
        <div>95 Mikheili Tsinamdzghvrishvili Street 0164 Tbilisi</div>
        <div>95 Mikheili Tsinamdzghvrishvili Street 0164 Tbilisi</div>

        <h5 class="info-title" style="margin-top: 80px;">Access map</h5>
        <div id="map">map</div>
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
