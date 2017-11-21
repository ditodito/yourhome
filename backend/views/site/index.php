<?php
use yii\bootstrap\Html;

$this->title = 'YourHomeHotel :: Admin Page';
?>

<div class="row">
    <div class="col-sm-3 col-md-2">
        <h4>ჩვენი ტურები</h4>
        <p><?=Html::a('გადასვლა &raquo;', ['tours/'], ['class' => 'btn btn-default'])?></p>
    </div>
    <div class="col-sm-3 col-md-2">
        <h4>ოთახები</h4>
        <p><?=Html::a('გადასვლა &raquo;', ['rooms/'], ['class' => 'btn btn-default'])?></p>
    </div>
    <div class="col-sm-3 col-md-2">
        <h4>შეკვეთები</h4>
        <p><?=Html::a('გადასვლა &raquo;', ['orders/'], ['class' => 'btn btn-default'])?></p>
    </div>
</div>
