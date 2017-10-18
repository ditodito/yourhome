<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class ServicesAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/services/services.css'
    ];

    public $depends = [
        'frontend\assets\AppAsset'
    ];

}