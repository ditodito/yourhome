<?php
switch($status) {
    case 1:
        $title = \Yii::t('order', 'Congratulations, your reservation is successfully completed');
        break;
    case 2:
        $title = \Yii::t('order', 'Reservation failed');
        break;
    case 3:
        $title = \Yii::t('order', 'Reservation canceled');
        break;
    case 4:
        $title = \Yii::t('order', 'Cancellation failed');
        break;
}
$this->title = 'YourHomeHotel :: '.$title;
?>

<div class="row">
    <div class="col-md-12">
        <?php if ($status == 1 || $status == 3): ?>
            <h4 class="text-center"><strong><?=$title?></strong></h4>
            <p class="text-center"><?=\Yii::t('order', 'Reservation number')?>: <strong><?=$reservation_number?></strong></p>
            <?php if ($status == 1): ?>
                <p><?=\Yii::t('order', 'We send a confirmation mail to')?> <strong><?=$email?></strong></p>
            <?php endif; ?>
            <p>
                <strong><?=\Yii::t('order', 'Cancellation policy')?></strong><br/>
                <?=\Yii::t('order', 'Reservation failed')?>.
                <?=\Yii::t('order', 'The guest will be charged the first night if they cancel within 24h before arrival')?>.
            </p>
        <?php elseif ($status == 2 || $status == 4): ?>
            <h4 class="text-center"><strong><?=$title?></strong></h4>
            <p class="text-center">
                <strong><?=\Yii::t('order', 'Please, try again or contact the hotel administration')?>:</strong>
            </p>
            <p class="text-center">
                <strong><?=\Yii::t('contacts', 'Tel')?> / <?=\Yii::t('contacts', 'Fax')?>: (+995 32) 221 00 00 (<?=\Yii::t('contacts', 'Аdministrator')?>)</strong>
            </p>
            <p class="text-center">
                <strong><?=\Yii::t('contacts', 'Cell')?>: (+995) 558 48 28 88 (<?=\Yii::t('contacts', 'Chief manager')?>)</strong>
            </p>
            <p class="text-center">
                <strong><?=\Yii::t('contacts', 'E-mail')?>: <?=\Yii::$app->params['infoEmail']?></strong>
            </p>
        <?php endif; ?>
    </div>
</div>