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
<?php $this->beginPage() ?>
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
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    /*NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();*/
    ?>

    <div class="container">
      <!--
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
      -->

        <header class="header">
            <?=Html::img('@web/img/logo.png', ['height' => 126, 'alt' => 'YourHome'])?>

            <ul class="menu">
                <li><?=Html::a(\Yii::t('menu', 'Home'), ['/site/index'])?></li>
                <li><?=Html::a('Rooms & Rates', ['/site/index'])?></li>
                <li><?=Html::a(\Yii::t('menu', 'Services'), ['/site/index'])?></li>
                <li><?=Html::a(\Yii::t('menu', 'Photos'), ['/site/index'])?></li>
                <li><?=Html::a(\Yii::t('menu', 'Contacts'), ['/site/contact'])?></li>
            </ul>

            <div id="languageWrapper">
                <?=Html::img(\Yii::getAlias('@web/img/flag_'.\Yii::$app->language.'.png'), ['height' => 16])?>
                <select name="languages" id="languages">
                    <option value="en-US" data-url="<?=Url::to(['site/change-language', 'lang' => 'en-US'])?>" <?php if (\Yii::$app->language == 'en-US') echo 'selected'; ?>>Eng</option>
                    <option value="ka-GE" data-url="<?=Url::to(['site/change-language', 'lang' => 'ka-GE'])?>" <?php if (\Yii::$app->language == 'ka-GE') echo 'selected'; ?>>Geo</option>
                    <option value="ru-RU" data-url="<?=Url::to(['site/change-language', 'lang' => 'ru-RU'])?>" <?php if (\Yii::$app->language == 'ru-RU') echo 'selected'; ?>>Rus</option>
                </select>
            </div>
        </header>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
