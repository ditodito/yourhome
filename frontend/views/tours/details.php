<?php
use frontend\assets\tours\DetailsAsset;

DetailsAsset::register($this);

$this->title = 'YourHomeHotel :: '.$tour->title;
?>

<h3 class="page-title"><?=$tour->title?></h3>
<div><?=$tour->text?></div>