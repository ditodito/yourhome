<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<header class="header">
    <div class="container">
        <?=Html::img('@web/img/logo.png', ['class' => 'logo', 'alt' => 'YourHome'])?>

        <div class="nav-wrapper">
            <nav class="nav">
                <?=Html::a(\Yii::t('menu', 'Home'), ['/site'])?>
                <?=Html::a(\Yii::t('menu', 'Rooms & Rates'), ['/site/rooms'])?>
                <?=Html::a(\Yii::t('menu', 'Service'), ['/site/services'])?>
                <?=Html::a(\Yii::t('menu', 'Photo Gallery'), ['/site/gallery'])?>
                <?=Html::a(\Yii::t('menu', 'Contacts'), ['/site/contact'])?>
                <?=Html::a(\Yii::t('menu', 'Our Tours'), ['/tours'], ['style' =>'float: right;'])?>
            </nav>

            <div id="languageWrapper">
                <?=Html::img(\Yii::getAlias('@web/img/flag_'.\Yii::$app->language.'.png'), ['height' => 16])?>
                <select name="languages" id="languages">
                    <option value="en-US" data-url="<?=Url::to(['site/change-language', 'lang' => 'en-US'])?>" <?php if (\Yii::$app->language == 'en-US') echo 'selected'; ?>>Eng</option>
                    <option value="ka-GE" data-url="<?=Url::to(['site/change-language', 'lang' => 'ka-GE'])?>" <?php if (\Yii::$app->language == 'ka-GE') echo 'selected'; ?>>Geo</option>
                    <option value="ru-RU" data-url="<?=Url::to(['site/change-language', 'lang' => 'ru-RU'])?>" <?php if (\Yii::$app->language == 'ru-RU') echo 'selected'; ?>>Rus</option>
                </select>
            </div>
        </div>
    </div>
    <div class="header-img"></div>
</header>