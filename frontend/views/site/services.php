<?php
use frontend\assets\ServicesAsset;

ServicesAsset::register($this);

$this->title = 'YourHomeHotel :: '.\Yii::t('menu', 'Service');
?>

<h3 class="page-title"><?=\Yii::t('services', 'Hotel facilities')?></h3>

<div class="service-wrapper">
    <div class="service-title"><?=\Yii::t('services', 'Hotel airport transfer (one way)')?>:</div>
    <div class="service-item">- <?=\Yii::t('services', 'by comfortable minivan')?> .... 80 ₾</div>
    <div class="service-item">- <?=\Yii::t('services', 'by car')?> .... 40 ₾</div>
</div>
<div class="service-wrapper">
    <div class="service-title"><?=\Yii::t('services', 'Extra towel')?>: ..... 3 ₾</div>
</div>
<div class="service-wrapper">
    <div class="service-title"><?=\Yii::t('services', 'Extra sofa bed per night')?>: ..... 25 ₾</div>
</div>
<div class="service-wrapper">
    <div class="service-title"><?=\Yii::t('services', 'Toiletries (slippers, shampoo, toothpaste, toothbrush, shower gel)')?>: ..... 3 ₾</div>
</div>

<ul class="service-list">
    <li><?=\Yii::t('main', 'Free')?> WiFi</li>
    <li><?=\Yii::t('services', '24-hour front desk')?></li>
    <li><?=\Yii::t('services', 'Free linens')?></li>
    <li><?=\Yii::t('services', 'Shared kitchenette (Microwave, Stovetop, Refrigerator, Kettle)')?></li>
    <li><?=\Yii::t('services', 'Shared bathroom (Hairdryer)')?></li>
    <li><?=\Yii::t('services', 'Luggage storage')?></li>
    <li><?=\Yii::t('services', 'Daily housekeeping')?></li>
    <li><?=\Yii::t('services', 'Non-smoking rooms')?></li>
    <li><?=\Yii::t('services', 'Dry cleaning')?></li>
</ul>

<h5 class="other-info-title"><?=\Yii::t('services', 'Other information available at the reception')?>:</h5>
<p><?=\Yii::t('services', 'Medical service, taxi, shops, souvenirs, hairdresser, restaurant, excursions...')?></p>

<div class="dgg"><?=\Yii::t('main', 'All prices Include {0}% VAT', [18])?></div>
