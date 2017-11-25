<?php

namespace backend\assets;

use common\assets\MomentAsset;
use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class DashboardAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'template/assets/global/plugins/fullcalendar/fullcalendar.min.css',
    ];
    public $js = [
        'template/assets/pages/scripts/dashboard.js',
        'template/assets/global/plugins/counterup/jquery.waypoints.min.js',
        'template/assets/global/plugins/counterup/jquery.counterup.min.js',
        'template/assets/global/plugins/fullcalendar/fullcalendar.min.js',
    ];
    public $depends = [
        AppAsset::class,
        MomentAsset::class
    ];
}
