<?php
use frontend\assets\RoomsAsset;
use yii\helpers\Html;

RoomsAsset::register($this);

$this->title = 'YourHomeHotel :: '.\Yii::t('menu', 'Rooms & Rates');
?>

<?php foreach($rooms as $room): ?>
    <div style="border: 1px solid #ccc; padding: 15px; margin-bottom: 50px;">
        <div class="row">
            <div class="col-md-5">
                <div class="room-image">
                    <?=Html::img(\Yii::getAlias('@web/img/rooms/'.$room->image), ['alt' => $room->name])?>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <ul class="room-include small">
                            <?php if ($room->free_wifi): ?>
                                <li><?=\Yii::t('main', 'Free')?> Wifi</li>
                            <?php endif; ?>
                            <?php if ($room->tv): ?>
                                <li><?=\Yii::t('rooms', 'TV')?></li>
                            <?php endif; ?>
                            <?php if ($room->air_conditioning): ?>
                                <li><?=\Yii::t('rooms', 'Air conditioning')?></li>
                            <?php endif; ?>
                            <?php if ($room->shared_bathroom): ?>
                                <li><?=\Yii::t('rooms', 'Shared bathroom')?></li>
                            <?php endif; ?>
                            <?php if ($room->private_bathroom): ?>
                                <li><?=\Yii::t('rooms', 'Private bathroom')?></li>
                            <?php endif; ?>
                            <?php if ($room->hairdryer): ?>
                                <li><?=\Yii::t('rooms', 'Hairdryer')?></li>
                            <?php endif; ?>
                            <?php if ($room->heating): ?>
                                <li><?=\Yii::t('rooms', 'Heating')?></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="col-xs-6">
                        <ul class="room-include small">
                            <?php if ($room->linen): ?>
                                <li><?=\Yii::t('rooms', 'Linen')?></li>
                            <?php endif; ?>
                            <?php if ($room->shared_kitchenette): ?>
                                <li><?=\Yii::t('rooms', 'Shared kitchenette')?></li>
                            <?php endif; ?>
                            <?php if ($room->private_kitchenette): ?>
                                <li><?=\Yii::t('rooms', 'Private kitchenette')?></li>
                            <?php endif; ?>
                            <?php if ($room->non_smoking): ?>
                                <li><?=\Yii::t('rooms', 'Non smoking')?></li>
                            <?php endif; ?>
                            <?php if ($room->toiletries): ?>
                                <li><?=\Yii::t('rooms', 'Toiletries')?></li>
                            <?php endif; ?>
                            <?php if ($room->towels): ?>
                                <li><?=\Yii::t('rooms', 'Towels')?></li>
                            <?php endif; ?>
                            <?php if ($room->slippers): ?>
                                <li><?=\Yii::t('rooms', 'Slippers')?></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <h5><strong><?=$room->name?></strong></h5>
                <p class="text-right"><strong><?=\Yii::t('main', 'Max')?>: <?=$room->capacity?></strong></p>
                <p style="margin-bottom: 25px;"><?=$room->description?></p>
                <p class="small"><strong><?=\Yii::t('order', 'Not included')?></strong></p>
                <ul class="room-include small" style="margin-bottom: 40px;">
                    <?php if ($room->id == 1): ?>
                        <li>Extra sofa bed - 25 GEL (per night, upon request)</li>
                    <?php else: ?>
                    <li>Towlers (<?=Html::a(\Yii::t('contacts', 'extra free'), ['site/services'])?>)</li>

                    <li>Toiletries (<?=Html::a(\Yii::t('contacts', 'extra free'), ['site/services'])?>)</li>
                    <?php endif; ?>
                </ul>

                <p class="text-right" style="margin-bottom: 25px;">
                    <strong><?=$room->price?> GEL</strong><br />
                    <?=\Yii::t('order', 'Included: {0} VAT', ['18%'])?><br />
                    <?=\Yii::t('order', 'Free cancellation 24h before arrival')?><br />
                    <?=\Yii::t('order', 'Payment at the hotel')?>
                </p>
                <p class="text-right">
                    <?=Html::a('Check availability and book', ['order/step1'], ['class' => 'step1_btn'])?>
                </p>
            </div>
        </div>
    </div>
<?php endforeach; ?>
