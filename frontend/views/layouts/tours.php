<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>

<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<body>
<?php $this->beginBody(); ?>
<div class="wrap">
    <?php include('blocks/header.php'); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-3 form-group">
                <div class="tours-nav">
                    <h4><?=\Yii::t('menu', 'Our Tours')?></h4>
                    <?php foreach($this->params['tours_durations'] as $duration): ?>
                        <h5><?=$duration->name?>:</h5>
                        <?php if (count($duration->tours) > 0): ?>
                            <div>
                                <?php foreach($duration->tours as $tour): ?>
                                    <div><?=Html::a('* '.$tour->title, ['/tours/details', 'id' => $tour->id])?></div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-md-9 form-group">
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