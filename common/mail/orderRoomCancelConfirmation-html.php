<?php
use common\api\models\database\Rooms;

$start_date = strtotime($order->start_date);
$end_date = strtotime($order->end_date);
$total_days = floor(($end_date - $start_date) / 86400);

$room = Rooms::findOne(['id' => $order_room->room_id]);
$price = $room->price * $total_days;

switch(\Yii::$app->language) {
    case 'ka-GE':
        $room_name = $room->name_ge;
        break;
    case 'ru-RU':
        $room_name = $room->name_ru;
        break;
    default:
        $room_name = $room->name_us;
}
?>

<h4 style="text-align: center; color: red; border-top: 2px solid red; border-bottom: 2px solid red; padding: 10px; margin-bottom: 15px;">
    <?=\Yii::t('order', 'Reservation canceled')?>
</h4>

<div style="text-align: center; font-weight: bold;">
    <?=\Yii::t('order', 'Dear Mr. / Mrs. {0}, we confirm that the following reservation is canceled', [$order->first_name])?>:
</div>
<div style="width: 60%; border: 1px solid #999; padding: 15px; margin: 15px auto;">
    <div style="margin-bottom: 10px;">
        <strong><?=$room_name?></strong>
    </div>
    <div style="margin-bottom: 10px;">
        <strong><?=\Yii::t('order', 'Check-in')?>:</strong>
        <?=\Yii::t('day', date('l', $start_date))?>
        <?=date('d', $start_date)?>
        <?=\Yii::t('month', date('F', $start_date))?>
        <?=date('Y', $start_date)?>,
        <?=\Yii::t('order', 'From 14:00 (2:00 PM)')?>
    </div>
    <div style="border-bottom: 1px solid #999; padding-bottom: 10px; margin-bottom: 10px;">
        <strong><?=\Yii::t('order', 'Check-out')?>:</strong>
        <?=\Yii::t('day', date('l', $end_date))?>
        <?=date('d', $end_date)?>
        <?=\Yii::t('month', date('F', $end_date))?>
        <?=date('Y', $end_date)?>,
        <?=\Yii::t('order', 'Until 12:00 (noon)')?>
    </div>
    <div style="text-align: right;">
        <strong><?=$price?> GEL</strong><br />
        (<?=\Yii::t('order', 'taxes included')?>)
    </div>
</div>
<div style="text-align: center; font-weight: bold; margin-bottom: 30px;">
    <?=\Yii::t('order', 'Reservation number')?>: <?=$order->id?>
</div>

<div><strong><?=\Yii::t('main', 'Hotel')?> YOUR HOME</strong></div>
<div style="margin-bottom: 10px;"><?=\Yii::t('contacts', '{0} Mikheili Tsinamdzghvrishvili Street, {1} Tbilisi, Georgia', ['95', '0164'])?></div>
<div><strong><?=\Yii::t('contacts', 'Tel')?> / <?=\Yii::t('contacts', 'Fax')?>:</strong> (+995 32) 221 00 00</div>
<div><strong><?=\Yii::t('contacts', 'Cell')?>:</strong> (+995) 558 48 28 88 (<?=\Yii::t('contacts', 'Manager')?>)</div>
<div><strong><?=\Yii::t('contacts', 'E-mail')?>:</strong> yourhometbilisi@yahoo.com</div>
<div style="margin-bottom: 15px;">www.yourhomehotel.ge</div>

<div><strong><?=strtoupper(\Yii::t('order', 'Cancellation policy'))?></strong></div>
<div>
    <?=\Yii::t('order', 'Cancellation is free 24h before arrival')?>.
    <?=\Yii::t('order', 'The guest will be charged the first night if they cancel within 24h before arrival')?>.
</div>