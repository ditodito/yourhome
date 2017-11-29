<?php
use common\api\models\database\Rooms;
use common\api\models\database\RoomsServices;

$start_date = strtotime($order->start_date);
$end_date = strtotime($order->end_date);
$total_days = floor(($end_date - $start_date) / 86400);
$total_price = 0;
?>

<div style="border: 1px solid #ccc;">
    <table style="width: 100%; height: 30px; border-collapse: collapse;">
        <tr>
            <td style="width: 50%; background-color: #8b7d72;"></td>
            <td style="width: 50%; background-color: #8bc652;"></td>
        </tr>
    </table>
    <div style="padding: 15px;">
        <div style="width: 100px; margin: auto;">
            <img src="<?=$message->embed($logo)?>" width="100" />
        </div>
        <h3 style="text-align: center; margin-bottom: 15px;"><?=\Yii::t('order', 'Thank you {0}, your reservation is confirmed', [$order->first_name])?></h3>
        <h3 style="text-align: center; margin-bottom: 30px;"><?=\Yii::t('order', 'Reservation number')?>: <?=$order->id?></h3>
        <div><strong><?=\Yii::t('main', 'Hotel')?> YOUR HOME</strong></div>
        <div style="margin-bottom: 10px;"><?=\Yii::t('contacts', '{0} Mikheili Tsinamdzghvrishvili Street, {1} Tbilisi, Georgia', ['95', '0164'])?></div>
        <div><strong><?=\Yii::t('contacts', 'Tel')?> / <?=\Yii::t('contacts', 'Fax')?>:</strong> (+995 32) 221 00 00</div>
        <div><strong><?=\Yii::t('contacts', 'Cell')?>:</strong> (+995) 558 48 28 88 (<?=\Yii::t('contacts', 'Manager')?>)</div>
        <div><strong><?=\Yii::t('contacts', 'E-mail')?>:</strong> <?=\Yii::$app->params['infoEmail']?></div>
        <div>www.yourhomehotel.ge</div>

        <div style="height: 15px; background-color: #8b7d72; margin: 15px 0;"></div>

        <h4><?=\Yii::t('order', 'Your reservation')?></h4>
        <?php foreach($order->ordersRoom as $order_room): ?>
            <?php
            $room = Rooms::findOne(['id' => $order_room->room_id]);
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
            <div style="width: 60%; border: 1px solid #999; padding: 15px; margin-bottom: 15px;">
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
                <div style="text-align: right; margin-bottom: 10px;">
                    <strong><?=$order_room->price * $total_days?> GEL</strong><br />
                    (<?=\Yii::t('order', 'taxes included')?>)
                </div>
                <div style="margin-bottom: 10px;">
                    <a href="<?=\Yii::$app->urlManager->createAbsoluteUrl(['order/remove-order-room', 'id' => $order_room->id, 'order_key' => $order->order_key])?>"><?=\Yii::t('order', 'Cancel this reservation')?></a>
                </div>
            </div>
        <?php endforeach; ?>

        <div style="padding: 0 15px; margin-bottom: 30px;">
            <strong><?=\Yii::t('services', 'Services')?>:</strong>
            <ul style="font-weight: bold;">
                <?php foreach($order->ordersRoom as $order_room): ?>
                    <?php foreach($order_room->services as $room_service): ?>
                        <?php
                        $service = RoomsServices::findOne(['id' => $room_service->room_service_id]);
                        switch(\Yii::$app->language) {
                            case 'ka-GE':
                                $service_name = $service->name_ge;
                                break;
                            case 'ru-RU':
                                $service_name = $service->name_ru;
                                break;
                            default:
                                $service_name = $service->name_us;
                        }
                        $service_price = ($room_service->per_night == 1) ? $room_service->price * $total_days : $room_service->price;
                        ?>
                        <li><?=$service_name?> = <?=$service_price?> GEL</li>
                    <?php endforeach; ?>
                <?php endforeach; ?>
                <?php if ($order->parking_reservation): ?>
                    <li><?=\Yii::t('services', 'Free private parking')?></li>
                <?php endif; ?>
                <?php if ($order->airport_transfer_price_id): ?>
                    <?php $ap = $order->airportTransferPrice; ?>
                    <li><?=\Yii::t('services', 'Airport transfer')?> <?=$ap->persons?> p = <?=$order->airportTransferPrice->price?> GEL</li>
                <?php endif; ?>
            </ul>

            <strong><?=\Yii::t('order', 'Total amount')?>: <?=$order->price?> GEL</strong><br />
            <?=\Yii::t('order', 'Included: {0} VAT', ['18%'])?>
        </div>

        <div style="height: 15px; background-color: #8b7d72; margin: 15px 0;"></div>

        <div style="margin-bottom: 10px;"><strong><?=\Yii::t('order', 'Cancel reservation')?></strong></div>
        <div style="margin-bottom: 10px;">
            <?=\Yii::t('order', 'Cancellation is free 24h before arrival')?>.
            <?=\Yii::t('order', 'The guest will be charged the first night if they cancel within 24h before arrival')?>.
        </div>
        <a href="<?=\Yii::$app->urlManager->createAbsoluteUrl(['order/remove-order', 'id' => $order->id, 'order_key' => $order->order_key])?>"><?=\Yii::t('order', 'Cancel all reservations')?></a>
    </div>
</div>