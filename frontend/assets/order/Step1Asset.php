<?php
namespace frontend\assets\order;

use yii\web\AssetBundle;

class Step1Asset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/order/step1.css'
    ];

    public $js = [
        'js/order/step1.js'
    ];

    public $depends = [
        'frontend\assets\AppAsset'
    ];

}