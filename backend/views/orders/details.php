<?php
use yii\bootstrap\Html;

$this->title = 'YourHomeHotel :: Admin Page';

$formatter = \Yii::$app->formatter;
?>

<div class="row">
    <div class="col-md-1 form-group">
        <?=Html::a(\Yii::t('main', 'Back'), ['orders/'], ['class' => 'btn btn-primary'])?>
    </div>
</div>
<div class="row">
    <div class="col-md-7">
        <div class="panel panel-primary">
            <div class="panel-heading"><?=\Yii::t('order', 'Your reservation')?></div>
            <div class="panel-body">
                <p><?=\Yii::t('order', 'Reservation number')?>: <?=$order->id?></p>
                <p><?=\Yii::t('order', 'First name')?>: <?=$order->first_name?></p>
                <p><?=\Yii::t('order', 'Last name')?>: <?=$order->last_name?></p>
                <p><?=\Yii::t('contacts', 'E-mail')?>: <?=$order->email?></p>
                <p><?=\Yii::t('order', 'Country')?>: <?=$order->country->country_name?></p>
                <p><?=\Yii::t('order', 'City')?>: <?=$order->city?></p>
                <p><?=\Yii::t('contacts', 'Address')?>: <?=$order->address?></p>
                <p><?=\Yii::t('order', 'Zip code')?>: <?=$order->zip_code?></p>
                <p><?=\Yii::t('order', 'Mobile')?>: <?=$order->mobile?></p>
                <p><?=\Yii::t('order', 'Special request')?>: <?=$order->comment?></p>
                <p><?=\Yii::t('order', 'Approximate arrival time')?>: <?=$order->arrival_time?></p>
                <p>
                    <?=\Yii::t('services', 'Airport transfer')?>:
                    <?php if ($order->airportTransferPrice): ?>
                        <?=$order->airportTransferPrice->persons?>p
                    <?php endif; ?>
                </p>
                <p>
                    <?=\Yii::t('services', 'Free private parking')?>:
                    <?php if ($order->parking_reservation): ?>
                        <span class="glyphicon glyphicon-ok"></span>
                    <?php endif; ?>
                </p>
                <p>
                    <?=\Yii::t('services', 'Breakfast')?>:
                    <?php if ($order->breakfast): ?>
                        <span class="glyphicon glyphicon-ok"></span>
                    <?php endif; ?>
                </p>
                <p><?=\Yii::t('order', 'Check in')?>: <?=$formatter->asDate($order->start_date, 'php:d/m/Y')?></p>
                <p><?=\Yii::t('order', 'Check out')?>: <?=$formatter->asDate($order->end_date, 'php:d/m/Y')?></p>
                <p><?=\Yii::t('order', 'Order date')?>: <?=$formatter->asDatetime($order->created, 'php:d/m/Y H:i')?></p>
                <p><?=\Yii::t('order', 'Cancel date')?>: <?=$formatter->asDatetime($order->canceled, 'php:d/m/Y H:i')?></p>
                <?=Html::a(\Yii::t('order', 'Cancel reservation'), ['orders/cancel-order', 'id' => $order->id], ['class' => 'btn btn-danger'])?>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="panel panel-primary">
            <div class="panel-heading"><?=\Yii::t('rooms', 'Rooms')?></div>
            <div class="panel-body">
                <?php foreach($order->ordersRoom as $order_room): ?>
                    <?php
                    switch(\Yii::$app->language) {
                        case 'ka-GE':
                            $room_name = $order_room->room->name_ge;
                            break;
                        case 'ru-RU':
                            $room_name = $order_room->room->name_ru;
                            break;
                        default:
                            $room_name = $order_room->room->name_us;
                    }
                    ?>
                    <p class="<?=($order_room->status == 1) ? 'text-success' : 'text-danger'?>"><?=$room_name?></p>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>