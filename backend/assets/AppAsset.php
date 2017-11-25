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
use common\assets\DatetimepickerAsset;
use yii\bootstrap\BootstrapPluginAsset;
use yii\web\AssetBundle;
use yii\web\YiiAsset;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'template/assets/global/plugins/simple-line-icons/simple-line-icons.min.css',
        'template/assets/global/css/components.min.css',
        'template/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css',
        'template/assets/global/css/plugins.min.css',
        //theme layout
        'template/assets/layouts/layout/css/layout.min.css',
        'template/assets/layouts/layout/css/themes/darkblue.min.css',
        'template/assets/layouts/layout/css/custom.min.css',
    ];
    public $js = [
        'js/plugins/jquery.blockUI.min.js',
        'js/plugins/jquery.alphanum.min.js',
        'js/plugins/jquery.bt.min.js',
        'js/plugins/offline.min.js',
	    'js/plugins/dataTables.conditionalPaging.js',
        //theme layout script
        'template/assets/global/plugins/js.cookie.min.js',
        'template/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js',
        'template/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.js',
        'template/assets/global/scripts/app.min.js',
        'template/assets/layouts/layout/scripts/layout.min.js',
    ];
    public $depends = [
        YiiAsset::class,
        BootstrapPluginAsset::class,
        DatatablesAsset::class,
        Select2Asset::class,
        DatepickerAsset::class,
        ToastrAsset::class,
        NumeralAsset::class,
        BootboxAsset::class,
        MomentAsset::class,
        FontAwesomeAsset::class,
        DatetimepickerAsset::class,
    ];
}
