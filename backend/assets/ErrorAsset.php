<?php

namespace backend\assets;

use common\assets\BootboxAsset;
use common\assets\DatatablesAsset;
use common\assets\DatepickerAsset;
use common\assets\FontAwesomeAsset;
use common\assets\MomentAsset;
use common\assets\NumeralAsset;
use common\assets\Select2Asset;
use common\assets\ToastrAsset;
use yii\bootstrap\BootstrapPluginAsset;
use yii\web\AssetBundle;
use yii\web\YiiAsset;

/**
 * Main backend application asset bundle.
 */
class ErrorAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'template/assets/global/css/components.min.css',
        //theme layout
        'template/assets/layouts/layout/css/layout.min.css',
        'template/assets/layouts/layout/css/themes/darkblue.min.css',
    ];
    public $depends = [
        BootstrapPluginAsset::class,
    ];
}
