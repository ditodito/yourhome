<?php
namespace frontend\assets\order;

use yii\web\AssetBundle;

class Step2Asset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/order/step2.css',
    ];

    public $js = [
        'js/order/step2.js',
    ];

    public $depends = [
        'frontend\assets\AppAsset'
    ];

}