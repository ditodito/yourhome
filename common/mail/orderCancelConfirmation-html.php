<h4 style="text-align: center; color: red; border-top: 2px solid red; border-bottom: 2px solid red; padding: 10px; margin-bottom: 15px;">
    <?=\Yii::t('order', 'Reservation canceled')?>
</h4>

<div style="text-align: center; font-weight: bold; margin-bottom: 15px;">
    <?=\Yii::t('order', 'Dear Mr. / Mrs. {0}, we confirm that the reservation is canceled', [$order->first_name . ' ' .$order->last_name])?>.
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