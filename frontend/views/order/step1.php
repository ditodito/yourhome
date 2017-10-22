<?php
use frontend\assets\order\Step1Asset;
use kartik\date\DatePicker;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\web\View;

Step1Asset::register($this);

$this->title = 'YourHomeHotel :: Order Step1';

$this->registerJs("var totalDays = ".$total_days.";", View::POS_HEAD);
?>

<div class="row">
    <div class="col-md-3 form-group">
        <div class="price-block">
            <div>
                <div><?=\Yii::t('order', 'Your price summary')?></div>
                <div><?=\Yii::t('order', 'Price')?> <div class="pull-right">GEL <span id="price">0</span></div></div>
            </div>
            <div>
                <div>18 % <?=\Yii::t('order', 'VAT')?> <span class="pull-right"><?=\Yii::t('order', 'Included')?></span></div>
                <div><?=\Yii::t('order', 'Free cancellation before 24h')?> *</div>
                <div><?=\Yii::t('order', 'Payment at the hotel')?></div>
            </div>
        </div>

        <div class="check-block">
            <div>
                <?=\Yii::t('order', 'Check in')?>:<br />
                - <?=\Yii::t('order', 'From 14:00 (2:00 PM)')?>
            </div>
            <div>
                <?=\Yii::t('order', 'Check out')?>:<br />
                - <?=\Yii::t('order', 'Until 12:00 (noon)')?>
            </div>
        </div>

        <div class="contact-info">
            <span><?=\Yii::t('contacts', 'Address')?>:</span>
            <div><?=\Yii::t('contacts', '{0} Mikheili Tsinamdzghvrishvili Street, {1} Tbilisi, Georgia', ['95', '0164'])?></div>
        </div>
        <div class="contact-info">
            <span><?=\Yii::t('contacts', 'Metro')?>:</span>
            <div>
                <div><?=\Yii::t('contacts', 'Line {0}', ['I'])?>, <?=\Yii::t('contacts', 'Station Marjanishvili')?></div>
                <div><?=\Yii::t('contacts', 'Open hours - {0} (6am-12am)', ['06:00-24:00'])?></div>
            </div>
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
    <div class="col-md-9 form-group">
        <div class="date-block">
            <div class="row">
                <div class="col-md-3 form-group">
                    <span class="small"><?=\Yii::t('order', 'Check in date')?>:</span><br />
                    <span style="color: #8bc652;">
                        <?=\Yii::t('day', date('D', $start_date))?>,
                        <?=\Yii::t('month', date('M', $start_date))?> <?=date('d', $start_date)?>,
                        <?=date('Y', $start_date)?>
                    </span>
                </div>
                <div class="col-md-3 form-group">
                    <span class="small"><?=\Yii::t('order', 'Check out date')?>:</span><br />
                    <span style="color: #8bc652">
                        <?=\Yii::t('day', date('D', $end_date))?>,
                        <?=\Yii::t('month', date('M', $end_date))?> <?=date('d', $end_date)?>,
                        <?=date('Y', $end_date)?>
                    </span>
                </div>
                <div class="col-md-3 form-group">
                    (<?=\Yii::t('order', '{0}-night stay ', [$total_days])?>)
                </div>
                <div class="col-md-3 form-group">
                    <button id="changeDate"><?=\Yii::t('order', 'Change date')?></button>
                </div>
            </div>
        </div>

        <?=Html::beginForm(['/order/step2'])?>
            <?=Html::hiddenInput('start_date', date('Y-m-d', $start_date))?>
            <?=Html::hiddenInput('end_date', date('Y-m-d', $end_date))?>
            <table class="table available-rooms">
                <thead>
                    <tr>
                        <th><?=\Yii::t('rooms', 'Room')?></th>
                        <th><?=\Yii::t('order', 'Price')?></th>
                        <th><?=\Yii::t('order', 'Select rooms')?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($available_rooms as $room): ?>
                        <?=Html::hiddenInput('rooms[]', $room->id)?>
                        <tr>
                            <td><?=$room->name?></td>
                            <td><?=$room->price?> GEL</td>
                            <td>
                                <select class="room-quantity" name="quantities[]">
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
                            <button type="submit" id="submitBtn" disabled>Book</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        <?=Html::endForm()?>

        * <?=\Yii::t('order', 'Cancellation is free 24h before arrival')?>. <?=\Yii::t('order', 'The guest will be charged the first night if they cancel within 24h before arrival')?>.
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="changeDateModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?=\Yii::t('order', 'Change date')?></h4>
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