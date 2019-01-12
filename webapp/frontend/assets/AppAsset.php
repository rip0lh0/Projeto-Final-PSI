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
        //'css/site.css',
        //'css/header.css',
        /* ESSENCE TEMPLATE */
        // FONTS
        // VENDOR
        // ESSENCE
        'css/core-style.css',
        'css/essence.css'
        /* END ESSENCE TEMPLATE */
    ];
    public $js = [
        //'js/main.js'
        /* ESSENCE TEMPLATE */
        // VENDOR
        // ESSENCE
        'js/popper.min.js',
        'js/classy-nav.min.js',
        'js/plugins.js',
        'js/active.js',
        /* END ESSENCE TEMPLATE */
    ];
    public $depends = [
        'yii\web\YiiAsset',
        // 'yii\bootstrap4\BootstrapPluginAsset',
        // 'yii\bootstrap4\BootstrapAsset',
        'yii\bootstrap4\BootstrapAsset',
        'yii\bootstrap4\BootstrapPluginAsset',
        '\rmrevin\yii\fontawesome\AssetBundle',
    ];
}
