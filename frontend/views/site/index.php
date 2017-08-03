<?php
use frontend\assets\IndexAsset;

IndexAsset::register($this);

$this->title = 'YourHome :: '.\Yii::t('menu', 'Home');
?>

<div class="row" style="margin-top: 15px;">
    <div class="col-md-4">
        <h4>Access map</h4>

        <div id="map">map</div>
    </div>
    <div class="col-md-6">
        <h4>About hotel</h4>

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
    <div class="col-md-2">
        <h4>Facilities</h4>

        <div class="facility">Free WiFi</div>
        <div class="facility">Free private parking</div>
        <div class="facility">24-hour front desc</div>
        <div class="facility">Luggage storage</div>
        <div class="facility">Kitchentte</div>
        <div class="facility">Airport transfer</div>

        <h4>Our tours</h4>
    </div>
</div>
