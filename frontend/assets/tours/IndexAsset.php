<?php
namespace frontend\assets\tours;

use yii\web\AssetBundle;

class IndexAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/tours/index.css',
        'css/tours/nav.css'
    ];

    public $depends = [
        'frontend\assets\AppAsset'
    ];

}