<?php
use frontend\assets\RoomsAsset;
use yii\helpers\Html;

RoomsAsset::register($this);

$this->title = 'YourHome :: '.\Yii::t('menu', 'Rooms & Rates');
?>

<?php foreach($rooms as $room): ?>
    <div class="row" style="border: 1px solid #ccc; margin-bottom: 50px;">
        <div class="col-md-5">
            <div class="room-image">
                <?=Html::img(\Yii::getAlias('@web/img/rooms/'.$room->image), ['alt' => $room->name])?>
            </div>
            <?php if ($room->free_wifi): ?>
                <div class="room-include"><?=\Yii::t('main', 'Free')?> Wifi</div>
            <?php endif; ?>
            <?php if ($room->tv): ?>
                <div class="room-include"><?=\Yii::t('rooms', 'TV')?></div>
            <?php endif; ?>
            <?php if ($room->air_conditioning): ?>
                <div class="room-include"><?=\Yii::t('rooms', 'Air conditioning')?></div>
            <?php endif; ?>
            <?php if ($room->shared_bathroom): ?>
                <div class="room-include"><?=\Yii::t('rooms', 'Shared bathroom')?></div>
            <?php endif; ?>
            <?php if ($room->private_bathroom): ?>
                <div class="room-include"><?=\Yii::t('rooms', 'Private bathroom')?></div>
            <?php endif; ?>
            <?php if ($room->hairdryer): ?>
                <div class="room-include"><?=\Yii::t('rooms', 'Hairdryer')?></div>
            <?php endif; ?>
            <?php if ($room->heating): ?>
                <div class="room-include"><?=\Yii::t('rooms', 'Heating')?></div>
            <?php endif; ?>
            <?php if ($room->linen): ?>
                <div class="room-include"><?=\Yii::t('rooms', 'Linen')?></div>
            <?php endif; ?>
            <?php if ($room->shared_kitchenette): ?>
                <div class="room-include"><?=\Yii::t('rooms', 'Shared kitchenette')?></div>
            <?php endif; ?>
            <?php if ($room->private_kitchenette): ?>
                <div class="room-include"><?=\Yii::t('rooms', 'Private kitchenette')?></div>
            <?php endif; ?>
            <?php if ($room->non_smoking): ?>
                <div class="room-include"><?=\Yii::t('rooms', 'Non smoking')?></div>
            <?php endif; ?>
            <?php if ($room->toiletries): ?>
                <div class="room-include"><?=\Yii::t('rooms', 'Toiletries')?></div>
            <?php endif; ?>
            <?php if ($room->towels): ?>
                <div class="room-include"><?=\Yii::t('rooms', 'Towels')?></div>
            <?php endif; ?>
            <?php if ($room->slippers): ?>
                <div class="room-include"><?=\Yii::t('rooms', 'Slippers')?></div>
            <?php endif; ?>
        </div>
        <div class="col-md-7">
            <h5 class="room-title"><?=$room->name?></h5>
            <div class="room-capacity"><?=\Yii::t('main', 'Max')?>: <?=$room->capacity?></div>
            <div class="room-description"><?=$room->description?></div>
            <div class="room-capacity"><?=$room->price?> GEL</div>
            <div class="room-capacity">Included 10% VAT</div>

            <div class="room-exclude">Not included</div>
            <div class="room-exclude">* Towlers (extra free)</div>
            <div class="room-exclude" style="margin-bottom: 15px;">* Toiletries (extra free)</div>

            <div class="room-exclude">Flexible rate</div>
            <div class="room-exclude">- Free cancellation before 24h</div>
            <div class="room-exclude">- Payment at the hotel</div>
        </div>
    </div>
<?php endforeach; ?>
