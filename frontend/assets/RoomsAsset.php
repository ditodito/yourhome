<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class RoomsAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/rooms/rooms.css'
    ];

    public $depends = [
        'frontend\assets\AppAsset'
    ];

}