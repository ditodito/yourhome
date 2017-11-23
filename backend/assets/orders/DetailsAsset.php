<?php
namespace backend\assets\orders;

use yii\web\AssetBundle;

class DetailsAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/orders/details.css'
    ];

    public $js = [
        'js/orders/details.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset'
    ];


}