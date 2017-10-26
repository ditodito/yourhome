<?php
use yii\helpers\Html;

$cancel_link = \Yii::$app->urlManager->createAbsoluteUrl(['order/remove', 'id' => $order->id, 'order_key' => $order->order_key]);
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
        <h3 style="text-align: center; margin-bottom: 15px;">Thank you <?=Html::encode($order->first_name)?>, your reservation is confirmed</h3>
        <h3 style="text-align: center; margin-bottom: 30px;">Reservation number: <?=Html::encode($order->id)?></h3>
        <div><strong><?=\Yii::t('main', 'Hotel')?> YOUR HOME</strong></div>
        <div style="margin-bottom: 10px;"><?=\Yii::t('contacts', '{0} Mikheili Tsinamdzghvrishvili Street, {1} Tbilisi, Georgia', ['95', '0164'])?></div>
        <div><strong><?=\Yii::t('contacts', 'Tel')?> / <?=\Yii::t('contacts', 'Fax')?>:</strong> (+995 32) 221 00 00</div>
        <div><strong><?=\Yii::t('contacts', 'Cell')?>:</strong> (+995) 558 48 28 88 (<?=\Yii::t('contacts', 'Manager')?>)</div>
        <div><strong><?=\Yii::t('contacts', 'E-mail')?>:</strong> yourhometbilisi@yahoo.com</div>
        <div>yourhomehotel.ge</div>

        <div style="height: 15px; background-color: #8b7d72; margin: 15px 0;"></div>
        <h4>Your reservation</h4>
        <div style="height: 15px; background-color: #8b7d72; margin: 15px 0;"></div>
        <div style="margin-bottom: 10px;"><strong>Cancel reservation</strong></div>
        <div style="margin-bottom: 10px;">
            <?=\Yii::t('order', 'Cancellation is free 24h before arrival')?>.
            <?=\Yii::t('order', 'The guest will be charged the first night if they cancel within 24h before arrival')?>.
        </div>
        <a href="<?=$cancel_link?>">Cancel total of reservation</a>
    </div>
</div>

