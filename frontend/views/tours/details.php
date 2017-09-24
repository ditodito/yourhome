<?php
use frontend\assets\tours\DetailsAsset;
use yii\bootstrap\Html;

DetailsAsset::register($this);

$this->title = 'YourHomeHotel :: '.$tour->title;
?>

<h3 class="page-title"><?=$tour->title?></h3>
<div><?=$tour->text?></div>
<?=Html::a('უკან გასვლა', Yii::$app->request->referrer)?>