<?php
use frontend\assets\order\Step1Asset;
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
        <div style="background-color: #e8f4dc; margin-bottom: 40px; padding: 10px;">
            <div style="margin-bottom: 20px; font-weight: bold;">
                18 % VAT <span style="float: right;">Included</span>
            </div>
            <div><?=\Yii::t('order', 'Free cancellation before 24h')?></div>
            <div><?=\Yii::t('order', 'Payment at the hotel')?></div>
        </div>
        <div style="border: 1px solid #e8f4dc; padding: 10px; font-weight: bold;">
            <p>
                <?=\Yii::t('order', 'Check-in')?>:<br />
                - From 14:00 (PM 2:00)
            </p>
            <p>
                <?=\Yii::t('order', 'Check-out')?>:<br />
                - Until 12:00 (noon)
            </p>
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
            <div style="width: 25%;">4</div>
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
    </div>
</div>