<?php
use frontend\assets\RoomsAsset;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

RoomsAsset::register($this);

$this->title = 'YourHomeHotel :: '.\Yii::t('menu', 'Rooms & Rates');
?>

<?php foreach($rooms as $room): ?>
    <div class="room-container">
        <div class="row">
            <div class="col-sm-5">
                <?=Html::img(\Yii::getAlias('@web/img/rooms/'.$room->image), ['class' => 'img-responsive', 'alt' => $room->name])?>

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
                    <div class="col-xs-6" style="padding: 0;">
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
            <div class="col-sm-7">
                <h5><strong><?=$room->name?></strong></h5>
                <p class="text-right"><strong><?=\Yii::t('main', 'Max')?>: <?=$room->capacity?></strong></p>
                <p class="room-description"><?=$room->description?></p>

                <p class="small"><strong><?=\Yii::t('order', 'Not included')?></strong></p>
                <ul class="room-include small" style="margin-bottom: 40px;">
                    <?php if ($room->id == 1): ?>
                        <li>Extra sofa bed - 25 GEL (per night, upon request)</li>
                    <?php endif; ?>
                    <?php if (!$room->towels): ?>
                        <li><?=\Yii::t('rooms', 'Towels')?> <?=Html::a('('.\Yii::t('rooms', 'extra free').')', ['site/services'])?></li>
                    <?php endif; ?>
                    <?php if (!$room->toiletries): ?>
                        <li><?=\Yii::t('rooms', 'Toiletries')?> <?=Html::a('('.\Yii::t('rooms', 'extra free').')', ['site/services'])?></li>
                    <?php endif; ?>
                </ul>

                <p class="text-right">
                    <strong><?=$room->price?> GEL</strong><br />
                    <span class="small"><?=\Yii::t('order', 'Included: {0} VAT', ['18%'])?></span><br />
                    <span class="small"><?=\Yii::t('order', 'Free cancellation 24h before arrival')?> *</span><br />
                    <span class="small"><?=\Yii::t('order', 'Payment at the hotel')?></span>
                </p>

                <?php $form = ActiveForm::begin(['action' => ['order/step1', 'show_form' => true], 'id' => 'roomForm'])?>
                    <?=Html::activeHiddenInput($model, 'start_date')?>
                    <?=Html::activeHiddenInput($model, 'end_date')?>
                    <?=Html::submitButton(\Yii::t('order', 'Check availability and book').' &raquo;', ['order/step1'], ['class' => 'step1_btn'])?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>

* <?=\Yii::t('order', 'Cancellation is free 24h before arrival')?>. <?=\Yii::t('order', 'The guest will be charged the first night if they cancel within 24h before arrival')?>.

