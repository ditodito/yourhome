<?php
    use yii\helpers\Html;
?>
<div class="side-banner">
    <?=Html::img(\Yii::getAlias('@web/img/side_banner.jpg'), ['alt' => 'Banner'])?>
</div>

<div class="side-info">
    <h5><?=\Yii::t('services', 'Our additional services and facilities')?></h5>
    <div>- <?=\Yii::t('services', 'Airport transfer(upon request)')?></div>
    <div>- <?=\Yii::t('services', '24-hour front desk')?></div>
    <?=Html::a('more...', ['/site/services'], ['class' => 'more'])?>
</div>

<div class="side-info">
    <h5>Our tours</h5>
    <div>
        <?=Html::img(\Yii::getAlias('@web/img/tours.png'), ['height' => 30, 'alt' => 'Tours'])?>
        Discover georgia with as.<br /> We organize different tours<br />
        <?=Html::a('more...', ['/site/tours'], ['class' => 'more'])?>
    </div>
</div>