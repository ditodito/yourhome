<?php
use frontend\assets\tours\IndexAsset;
use yii\bootstrap\Html;

IndexAsset::register($this);

$this->title = 'YourHomeHotel :: '.\Yii::t('menu', 'Our Tours');
?>

<h3 class="page-title"><?=\Yii::t('tours', 'Our tours in Georgia')?></h3>
<p><?=\Yii::t('tours', 'Here you can find our most popular tours. We also make all tours according to your request and number of days')?>.</p>
<p><?=\Yii::t('tours', 'Request information on excursions at {0} Hotel Desk', ['"Your Home"'])?>.</p>

<div class="row">
    <?php foreach($tours as $tour): ?>
        <div class="col-md-4 col-sm-6">
            <?=Html::a(Html::img('@web/img/tours/'.$tour->image, [
                'class' => 'img-responsive img-rounded',
                'alt' => $tour->title
            ]), ['/tours/details', 'id' => $tour->id])?>
            <p class="text-center"><?=Html::a($tour->title, ['/tours/details', 'id' => $tour->id])?></p>
        </div>
    <?php endforeach; ?>
</div>
