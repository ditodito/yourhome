<?php
use frontend\assets\order\Step1Asset;
use kartik\date\DatePicker;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

Step1Asset::register($this);
?>

<div class="row">
    <div class="col-md-3">
        <div style="background-color: #a7d47b; padding: 10px;">
            Your price summary
            <div style="margin-top: 10px; font-weight: bold;">
                <?=\Yii::t('order', 'Price')?> <span id="price" style="float: right;">GEL <span>0</span></span>
            </div>
        </div>
        <div style="background-color: #e8f4dc; padding: 10px;">
            <div style="margin-bottom: 20px; font-weight: bold;">
                18 % VAT <span style="float: right;">Included</span>
            </div>
            <div><?=\Yii::t('order', 'Free cancellation before 24h')?> *</div>
            <div><?=\Yii::t('order', 'Payment at the hotel')?></div>
        </div>

        <div class="check-block">
            <div>
                <?=\Yii::t('order', 'Check-in')?>:<br />
                - <?=\Yii::t('order', 'From 14:00 (2:00 PM)')?>
            </div>
            <div>
                <?=\Yii::t('order', 'Check-out')?>:<br />
                - <?=\Yii::t('order', 'Until 12:00 (noon)')?>
            </div>
        </div>

        <div class="contact-info">
            <span><?=\Yii::t('contacts', 'Address')?>:</span>
            <div><?=\Yii::t('contacts', '{0} Mikheili Tsinamdzghvrishvili Street, {1} Tbilisi, Georgia', ['95', '0164'])?></div>
        </div>
        <div class="contact-info">
            <span><?=\Yii::t('contacts', 'Metro')?>:</span>
            <p>
                <?=\Yii::t('contacts', 'Line {0}', ['I'])?>, <?=\Yii::t('contacts', 'Station Marjanishvili')?>
                <br /><?=\Yii::t('contacts', 'Open hours - {0} (6am-12am)', ['06:00-24:00'])?>
            </p>
        </div>
        <div class="contact-info">
            <span><?=\Yii::t('contacts', 'Bus')?>:</span>
            <div>N122, <?=\Yii::t('contacts', 'Station Tsinamdzghvrishvili')?></div>
        </div>
        <div class="contact-info">
            <span><?=\Yii::t('menu', 'Contacts')?>:</span>
            <div>
                <div><?=\Yii::t('contacts', 'Tel')?> / <?=\Yii::t('contacts', 'Fax')?>: (+995 32) 221 00 00</div>
                <div><?=\Yii::t('contacts', 'Cell')?>: (+995) 558 48 28 88 (<?=\Yii::t('contacts', 'Manager')?>)</div>
                <div><?=\Yii::t('contacts', 'E-mail')?>: yourhometbilisi@yahoo.com</div>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <h4 style="margin-top: 0;">Availability</h4>
        <div style="background-color: #e8f4dc; padding: 30px; display: flex; width: 100%; font-weight: bold;">
            <div style="width: 25%;">
                <span class="small">Check In Date:</span><br />
                <span style="color: #8bc652;" class=""><?=$check_in?></span>
            </div>
            <div style="width: 25%;">
                <span class="small">Check Out Date:</span><br />
                <span style="color: #8bc652"><?=$check_out?></span>
            </div>
            <div style="width: 25%;">
                (<?=$days?>-night stay)
            </div>
            <div style="width: 25%;">
                <button id="changeDate">change date</button>
            </div>
        </div>

        <?=Html::beginForm(['/order/step2'])?>
            <?=Html::hiddenInput('start_date', $start_date)?>
            <?=Html::hiddenInput('end_date', $end_date)?>
            <table class="table available-rooms">
                <thead>
                    <tr>
                        <th><?=\Yii::t('rooms', 'Room')?></th>
                        <th><?=\Yii::t('order', 'Price')?></th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($available_rooms as $room): ?>
                        <?=Html::hiddenInput('room_ids[]', $room->id)?>
                        <tr>
                            <td><?=$room->name?></td>
                            <td><?=$room->price?> GEL</td>
                            <td>
                                <select class="room-quantity" name="capacities[]">
                                    <option value="0" data-price="0"></option>
                                    <?php for($i = 1; $i <= $room->available_rooms; $i++): ?>
                                        <option value="<?=$i?>" data-price="<?=$room->price?>"><?=$i.' ('.$room->price.' GEL)'?></option>
                                    <?php endfor; ?>
                                </select>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>
                            <button type="submit" daa-id="<?=$room->id?>" style="outline: none; background-color: #8bc652; border: none; padding: 3px 15px;">Book</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        <?=Html::endForm()?>

        * Cancellation is free 24h before arrival. The guest will be charged the first night if they cancel within 24h before arrival.
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="changeDateModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Change your details</h4>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin([
                    'action' => ['/order/step1']
                ]); ?>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label"><?=\Yii::t('order', 'Check-in')?></label>
                            <?=$form->field($order_form, 'start_date')->widget(DatePicker::classname(), [
                                'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                'size' => 'sm',
                                'pickerButton' => [
                                    'title' => false,
                                    'style' => 'background-color: #fff; border-right: none; border-radius: 0;'
                                ],
                                'removeButton' => false,
                                'options' => [
                                    //'placeholder' => '1',
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
                                        }",
                                ]
                            ])->label(false)->error(false)?>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label"><?=\Yii::t('order', 'Check-out')?></label>
                            <?=$form->field($order_form, 'end_date')->widget(DatePicker::classname(), [
                                'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                'size' => 'sm',
                                'pickerButton' => [
                                    'title' => false,
                                    'style' => 'background-color: #fff; border-right: none; border-radius: 0;'
                                ],
                                'removeButton' => false,
                                'options' => [
                                    //'placeholder' => '1',
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
                            <?=Html::submitButton('Book Now')?>
                        </div>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>