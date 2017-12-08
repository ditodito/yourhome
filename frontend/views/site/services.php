<?php
use frontend\assets\ServicesAsset;
use yii\bootstrap\Html;

ServicesAsset::register($this);

$this->title = 'YourHomeHotel :: '.\Yii::t('menu', 'Service');
?>

<h3 class="page-title"><?=\Yii::t('services', 'Hotel facilities')?></h3>

<ul class="price-list">
    <li><strong><?=\Yii::t('services', 'Hotel airport transfer (one way)')?></strong></li>
    <li class="dotted" style="padding-left: 25px;">
        <span>- <?=\Yii::t('services', 'by comfortable minivan')?></span>
        <span>80 GEL</span>
    </li>
    <li class="dotted" style="padding-left: 25px;">
        <span>- <?=\Yii::t('services', 'by car')?></span>
        <span>40 GEL</span>
    </li>
    <li class="dotted">
        <span><strong><?=\Yii::t('services', 'Extra towel')?></strong></span>
        <span>3 GEL</span>
    </li>
    <li class="dotted">
        <span><strong><?=\Yii::t('services', 'Extra sofa bed per night')?></strong></span>
        <span>25 GEL</span>
    </li>
    <li class="dotted">
        <span>
            <strong><?=\Yii::t('rooms', 'Toiletries')?></strong>
            (<?=\Yii::t('rooms', 'Slippers')?>,
            <?=\Yii::t('rooms', 'Shampoo')?>,
            <?=\Yii::t('rooms', 'Toothpaste')?>,
            <?=\Yii::t('rooms', 'Toothbrush')?>,
            <?=\Yii::t('rooms', 'Shower gel')?>)
        </span>
        <span>3 GEL</span>
    </li>
</ul>

<ul class="service-list">
    <li><?=\Yii::t('main', 'Free')?> WiFi</li>
    <li><?=\Yii::t('services', '24-hour front desk')?></li>
    <li><?=\Yii::t('services', 'Free linens')?></li>
    <li><?=\Yii::t('services', 'Shared kitchenette (Microwave, Stovetop, Refrigerator, Kettle)')?></li>
    <li><?=\Yii::t('services', 'Shared bathroom (Hairdryer)')?></li>
    <li><?=\Yii::t('services', 'Free private parking')?> (<?=\Yii::t('contacts', 'upon request')?>)</li>
    <li><?=\Yii::t('services', 'Luggage storage')?></li>
    <li><?=\Yii::t('services', 'Daily housekeeping')?></li>
    <li><?=\Yii::t('services', 'Non-smoking rooms')?></li>
    <li><?=\Yii::t('services', 'Dry cleaning')?></li>
</ul>

<h5 class="other-info-title"><?=\Yii::t('services', 'Other information available at the reception')?>:</h5>
<p><?=\Yii::t('services', 'Medical service, taxi, shops, souvenirs, hairdresser, restaurant, excursions...')?></p>

<div class="our-tours">
    <h4><?=\Yii::t('menu', 'Our Tours')?></h4>
    <p><?=Html::a(\Yii::t('tours', 'Discover Georgia with us, we organize the different excursions'), ['tours/'])?></p>
    <?=Html::img(\Yii::getAlias('@web/img/our_tours.jpg'), [
        'class' => 'img-rounded img-responsive',
        'alt' => \Yii::t('menu', 'Our Tours')
    ])?>
</div>


<div class="dgg"><?=\Yii::t('main', 'All prices Include {0}% VAT', [18])?></div>
