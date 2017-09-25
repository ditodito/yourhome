<?php
use frontend\assets\tours\DetailsAsset;
use yii\bootstrap\Html;

DetailsAsset::register($this);

$this->title = 'YourHomeHotel :: '.$tour->title;
?>

<h3 class="page-title"><?=$tour->title?></h3>
<div class="page-content"><?=$tour->text?></div>
&laquo; <?=Html::a(\Yii::t('main', 'Back'), ['/tours'], ['class' => 'back'])?>