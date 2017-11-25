<?php

namespace backend\assets;

use yii\bootstrap\BootstrapPluginAsset;
use yii\web\AssetBundle;
use yii\web\YiiAsset;

/**
 * Main backend application asset bundle.
 */
class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'template/assets/global/plugins/font-awesome/css/font-awesome.min.css',
        'template/assets/global/plugins/simple-line-icons/simple-line-icons.min.css',
        'template/assets/global/css/components.css',
        'template/assets/global/css/plugins.css',
        //login page css
        'template/assets/pages/css/login.min.css',
    ];
    public $js = [
        'template/assets/global/scripts/app.min.js',
        'template/assets/pages/scripts/login.js',
    ];
    public $depends = [
        YiiAsset::class,
        BootstrapPluginAsset::class,
    ];
}
