<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class GalleryAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/gallery/gallery.css'
    ];

    public $js = [
        'js/gallery/gallery.js'
    ];

    public $depends = [
        'frontend\assets\AppAsset'
    ];

}