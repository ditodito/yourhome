<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class IndexAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/index/index.css'
    ];

    public $js = [
        'js/index/index.js',
        'https://maps.googleapis.com/maps/api/js?key=AIzaSyAju67w32shYoNSFJHSQKKHTy4E77jnLSY&callback=initMap'
    ];

    public $depends = [
        'frontend\assets\AppAsset'
    ];

}