<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/jquery-confirm.min',
        'css/mb.balloon.css',
    ];
    public $js = [
        'js/main.js',
        'js/avatar.js',
        'js/tilt.jquery.js',
        'js/jquery-confirm.min.js',
        'js/jquery.mb.balloon.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
