<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class ContactAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/contact/contact.css',
    ];

    public $js = [
        'js/contact/contact.js',
        'https://maps.googleapis.com/maps/api/js?key=AIzaSyAju67w32shYoNSFJHSQKKHTy4E77jnLSY&callback=initMap'
    ];

    public $depends = [
        'frontend\assets\AppAsset'
    ];

}