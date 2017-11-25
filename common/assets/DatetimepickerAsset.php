<?php

namespace common\assets;

use yii\web\AssetBundle;

class DatetimepickerAsset extends AssetBundle
{
    public $sourcePath = '@bower/smalot-bootstrap-datetimepicker';
    public $css = [
        'css/bootstrap-datetimepicker.min.css'
    ];
    public $js = [
        'js/bootstrap-datetimepicker.min.js',
        'js/locales/bootstrap-datepicker.vi.js'
    ];
    public $jsOptions = [
        'defer' => 'defer'
    ];
}