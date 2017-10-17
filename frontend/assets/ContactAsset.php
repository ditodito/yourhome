<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class ContactAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/contact/contact.css',
    ];

    public $depends = [
        'frontend\assets\AppAsset'
    ];

}