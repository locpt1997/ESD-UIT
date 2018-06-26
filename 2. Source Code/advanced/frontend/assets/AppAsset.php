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
        'css/shop-homepage.css',
        'vendor/bootstrap/css/bootstrap.min.css',
    ];
    public $js = [
        'vendor/jquery/jquery.min.js',
        'vendor/bootstrap/js/bootstrap.bundle.min.js',
    ];
    public $depends = [
     //   'yii\web\YiiAsset',
     //   'yii\bootstrap\BootstrapAsset',
    ];
}
