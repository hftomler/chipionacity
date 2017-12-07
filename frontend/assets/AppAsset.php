<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/mb.balloon.css',
        'css/borderEffect.css',
        'css/weather.css'
    ];
    public $js = [
        'js/main.js',
        'js/avatar.js',
        'js/jquery.mb.balloon.js',
        'js/jquery-ui-1.10.3.custom.min.js',
        'js/weather.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
