<?php
namespace frontend\assets\tours;

use yii\web\AssetBundle;

class DetailsAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/tours/details.css',
    ];

    public $depends = [
        'frontend\assets\AppAsset'
    ];

}