<?php
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\overlays\Marker;
use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::register($this);

$query_params = \Yii::$app->request->queryParams;
$tour_id = array_key_exists('id', $query_params) ? $query_params['id'] : '0';
?>

<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language?>">
<head>
    <meta charset="<?=Yii::$app->charset?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?=Html::csrfMetaTags()?>
    <title><?=Html::encode($this->title)?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody(); ?>
    <div class="wrap">
        <?php include('blocks/header.php'); ?>

        <div class="container">
            <div class="row">
                <div class="col-sm-3 form-group">
                    <div class="tours-nav">
                        <h4><?=\Yii::t('menu', 'Our Tours')?></h4>
                        <?php foreach($this->params['tours_durations'] as $duration): ?>
                            <h5><?=$duration->name?>:</h5>
                            <?php if (count($duration->tours) > 0): ?>
                                <ul>
                                    <?php foreach($duration->tours as $tour): ?>
                                        <li><?=Html::a($tour->title, ['/tours/details', 'id' => $tour->id], ['class' => ($tour_id == $tour->id) ? 'active' : ''])?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>

                    <div class="tours-contact">
                        <span><?=\Yii::t('contacts', 'Access Map')?>:</span>
                        <?php
                        $coord = new LatLng(['lat' => 41.712990, 'lng' => 44.798526]);
                        $map = new Map([
                            'width' => '100%',
                            'height' => '250',
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

                    <div class="tours-contact">
                        <span><?=\Yii::t('contacts', 'Address')?>:</span>
                        <div><?=\Yii::t('contacts', '{0} Mikheili Tsinamdzghvrishvili Street, {1} Tbilisi, Georgia', ['93/95', '0164'])?></div>
                    </div>
                    <div class="tours-contact">
                        <span><?=\Yii::t('contacts', 'Metro')?>:</span>
                        <div>
                            <?=\Yii::t('contacts', 'Line {0}', ['I'])?>, <?=\Yii::t('contacts', 'Station Marjanishvili')?>
                            <br /><?=\Yii::t('contacts', 'Open hours - {0} (6am-12am)', ['06:00-24:00'])?>
                        </div>
                    </div>
                    <div class="tours-contact">
                        <span><?=\Yii::t('contacts', 'Bus')?>:</span>
                        <div>N122, <?=\Yii::t('contacts', 'Station Tsinamdzghvrishvili')?></div>
                    </div>
                    <div class="tours-contact">
                        <span><?=\Yii::t('menu', 'Contacts')?>:</span>
                        <div>
                            <div><?=\Yii::t('contacts', 'Tel')?> / <?=\Yii::t('contacts', 'Fax')?>: (+995 32) 221 00 00</div>
                            <div><?=\Yii::t('contacts', 'Cell')?>: (+995) 558 48 28 88 (<?=\Yii::t('contacts', 'Chief manager')?>)</div>
                            <div><?=\Yii::t('contacts', 'E-mail')?>: <?=\Yii::$app->params['infoEmail']?></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9 form-group">
                    <?=$content?>
                </div>
            </div>
        </div>
    </div>
    <?php include('blocks/footer.php'); ?>
    <?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>