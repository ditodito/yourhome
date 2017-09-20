<?php
use frontend\assets\GalleryAsset;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\View;

GalleryAsset::register($this);

$this->title = 'YourHomeHotel :: '.\Yii::t('menu', 'Photo Gallery');

$php_data = [
    'webDir' => \Yii::getAlias('@web')
];
$this->registerJs("var phpData = ".Json::encode($php_data), View::POS_END);
?>

<h3 class="page-title"><?=\Yii::t('menu', 'Photo Gallery')?></h3>

<div class="page-description"><?=\Yii::t('gallery', 'You will be able to see all the hotel facilities in our photo gallery')?></div>

<?=Html::img(\Yii::getAlias('@web/img/gallery/'.$images[0]->image_name), ['class' => 'img-main', 'alt' => $images[0]->description])?>
<?php foreach($images as $key => $image): ?>
    <?php $active_class = ($key == 0) ? 'img-item-active' : ''; ?>
    <?=Html::img(\Yii::getAlias('@web/img/gallery/'.$image->image_name_thumb), ['class' => 'img-item '.$active_class, 'alt' => $image->description, 'data-image' => $image->image_name])?>
<?php endforeach; ?>
