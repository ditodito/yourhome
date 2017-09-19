<?php
use frontend\assets\GalleryAsset;
use yii\helpers\Html;

GalleryAsset::register($this);

$this->title = 'YourHomeHotel :: '.\Yii::t('menu', 'Photo Gallery');
?>

<h3 class="page-title"><?=\Yii::t('menu', 'Photo Gallery')?></h3>

<div class="page-description"><?=\Yii::t('gallery', 'You will be able to see all the hotel facilities in our photo gallery')?></div>

<?=Html::img(\Yii::getAlias('@web/img/gallery/'.$images[0]), ['class' => 'img-main', 'alt' => $images[0]])?>
<?php foreach($images as $image): ?>
    <?=Html::img(\Yii::getAlias('@web/img/gallery/'.$image), ['class' => 'img-item', 'alt' => $image])?>
<?php endforeach; ?>
