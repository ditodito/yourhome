<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<header class="header">
    <div class="container">
        <?=Html::img('@web/img/logo.png', ['height' => 126, 'alt' => 'YourHome'])?>

        <ul class="menu">
            <li><?=Html::a(\Yii::t('menu', 'Home'), ['/site/index'])?></li>
            <li><?=Html::a(\Yii::t('menu', 'Rooms & Rates'), ['/site/rooms'])?></li>
            <li><?=Html::a(\Yii::t('menu', 'Service'), ['/site/index'])?></li>
            <li><?=Html::a(\Yii::t('menu', 'Photo Gallery'), ['/site/index'])?></li>
            <li><?=Html::a(\Yii::t('menu', 'Contacts'), ['/site/contact'])?></li>
            <li><?=Html::a(\Yii::t('menu', 'Our Tours'), ['/site/contact'])?></li>
        </ul>

        <div id="languageWrapper">
            <?=Html::img(\Yii::getAlias('@web/img/flag_'.\Yii::$app->language.'.png'), ['height' => 16])?>
            <select name="languages" id="languages">
                <option value="en-US" data-url="<?=Url::to(['site/change-language', 'lang' => 'en-US'])?>" <?php if (\Yii::$app->language == 'en-US') echo 'selected'; ?>>Eng</option>
                <option value="ka-GE" data-url="<?=Url::to(['site/change-language', 'lang' => 'ka-GE'])?>" <?php if (\Yii::$app->language == 'ka-GE') echo 'selected'; ?>>Geo</option>
                <option value="ru-RU" data-url="<?=Url::to(['site/change-language', 'lang' => 'ru-RU'])?>" <?php if (\Yii::$app->language == 'ru-RU') echo 'selected'; ?>>Rus</option>
            </select>
        </div>
    </div>
    <div class="header-img"></div>
</header>