<?php
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\overlays\Marker;
use frontend\assets\ContactAsset;

ContactAsset::register($this);

$this->title = 'YourHomeHotel :: '.\Yii::t('menu', 'Contacts');
?>

<h3 class="page-title"><?=\Yii::t('menu', 'Contacts')?></h3>
<div class="row">
    <div class="col-md-12">
        <div class="info-wrapper">
            <h5><?=\Yii::t('contacts', 'Address')?>:</h5>
            <div><?=\Yii::t('contacts', '{0} Mikheili Tsinamdzghvrishvili Street, {1} Tbilisi, Georgia', ['95', '0164'])?></div>
        </div>
        <div class="info-wrapper">
            <h5><?=\Yii::t('contacts', 'Metro')?>:</h5>
            <div>
                <?=\Yii::t('contacts', 'Line {0}', ['I'])?>, <?=\Yii::t('contacts', 'Station Marjanishvili')?><br />
                <?=\Yii::t('contacts', 'Open hours - {0} (6am-12am)', ['06:00-24:00'])?>
            </div>
        </div>
        <div class="info-wrapper">
            <h5><?=\Yii::t('contacts', 'Bus')?>:</h5>
            <div>N122, <?=\Yii::t('contacts', 'Station Tsinamdzghvrishvili')?></div>
        </div>
        <div class="info-wrapper">
            <h5><?=\Yii::t('contacts', 'General information')?>:</h5>
            <div class="row">
                <div class="col-sm-5">
                    <div>
                        <?=\Yii::t('contacts', 'Tel')?> / <?=\Yii::t('contacts', 'Fax')?>: (+995 32) 221 00 00<br />
                        <?=\Yii::t('contacts', 'Cell')?>: (+995) 558 48 28 88 (<?=\Yii::t('contacts', 'Chief manager')?>)<br />
                        <?=\Yii::t('contacts', 'E-mail')?>: <?=\Yii::$app->params['infoEmail']?><br />
                    </div>
                </div>
                <div class="col-sm-5">
                    <div>
                        <?=\Yii::t('contacts', 'Cell')?>: (+995) 577 53 72 12 (<?=\Yii::t('contacts', 'Russian')?>/<?=\Yii::t('contacts', 'Hebrew')?>)<br />
                        <?=\Yii::t('contacts', 'Cell')?>: (+995) 577 54 75 75 (<?=\Yii::t('contacts', 'German')?>)<br />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="info-wrapper">
            <h5><?=\Yii::t('contacts', 'Access Map')?></h5>
            <?php
            $coord = new LatLng(['lat' => 41.712990, 'lng' => 44.798526]);
            $map = new Map([
                'width' => '100%',
                'height' => '400',
                'center' => $coord,
                'zoom' => 17
            ]);
            $marker = new Marker([
                'position' => $coord,
                'title' => 'YourHomeHotel.Ge'
            ]);
            $map->addOverlay($marker);
            echo $map->display();
            ?>
        </div>
    </div>
</div>

