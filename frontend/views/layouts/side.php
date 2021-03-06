<?php
use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::register($this);
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
                    <?php include('blocks/side.php'); ?>
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
