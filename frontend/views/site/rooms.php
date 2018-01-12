<?php
use frontend\assets\RoomsAsset;
use kartik\date\DatePicker;
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
                        <li><?=\Yii::t('rooms', 'Extra sofa bed - {0} GEL (per night, upon request)', ['25'])?></li>
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

                <div class="change-date-wrapper">
                    <?=Html::button(\Yii::t('order', 'Check availability and book').' &raquo;', ['class' => 'change-date'])?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

* <?=\Yii::t('order', 'Cancellation is free 24h before arrival')?>. <?=\Yii::t('order', 'The guest will be charged the first night if they cancel within 24h before arrival')?>.

<div class="modal fade" tabindex="-1" role="dialog" id="changeDateModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?=\Yii::t('order', 'Change date')?></h4>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin(['action' => ['order/step1']]); ?>
                <div class="row">
                    <div class="col-md-4">
                        <label class="control-label"><?=\Yii::t('order', 'Check-in')?></label>
                        <?=$form->field($model, 'start_date')->widget(DatePicker::classname(), [
                            'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                            'size' => 'sm',
                            'pickerButton' => [
                                'title' => false,
                                'style' => 'background-color: #fff; border-right: none; border-radius: 0;'
                            ],
                            'removeButton' => false,
                            'options' => [
                                'style' => 'border-left: none; border-radius: 0;'
                            ],
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'mm/dd/yyyy',
                                'startDate' => date('m/d/Y', time()),
                            ],
                            'pluginEvents' => [
                                "clearDate" => "function(e) {
                                        $('#orderform-end_date').kvDatepicker('clearDates');
                                    }",
                                "changeDate" => "function(e) {
                                        $('#orderform-end_date').kvDatepicker('clearDates');
                                        var start_day = new Date($('#orderform-start_date').val());
                                        var next_day = new Date(start_day.getTime() + 86400000);
                                        $('#orderform-end_date').kvDatepicker('setStartDate', next_day.toLocaleDateString());
                                    }"
                            ]
                        ])->label(false)->error(false)?>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label"><?=\Yii::t('order', 'Check-out')?></label>
                        <?=$form->field($model, 'end_date')->widget(DatePicker::classname(), [
                            'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                            'size' => 'sm',
                            'pickerButton' => [
                                'title' => false,
                                'style' => 'background-color: #fff; border-right: none; border-radius: 0;'
                            ],
                            'removeButton' => false,
                            'options' => [
                                'style' => 'border-left: none; border-radius: 0;'
                            ],
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'mm/dd/yyyy',
                                'startDate' => date('m/d/Y', time() + 86400),
                            ]
                        ])->label(false)->error(false)?>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label">&nbsp;</label>
                        <?=Html::submitButton(\Yii::t('order', 'Book'))?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>