<?php
use yii\bootstrap\Html;

$this->title = 'YourHomeHotel :: Admin Page';
?>

<div class="row">
    <div class="col-lg-4">
    </div>
    <div class="col-lg-4">
        <h4>ჩვენი ტურები</h4>
        <p><?=Html::a('გადასვლა &raquo;', ['/tours'], ['class' => 'btn btn-default'])?></p>
    </div>
    <div class="col-lg-4">
    </div>
</div>
