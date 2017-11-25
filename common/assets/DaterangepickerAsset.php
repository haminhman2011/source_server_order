<?php

namespace common\assets;

use yii\web\AssetBundle;

class DaterangepickerAsset extends AssetBundle
{
    public $sourcePath = '@bower/bootstrap-daterangepicker';
    public $css = [
        'daterangepicker.css'
    ];
    public $js = [
        'daterangepicker.js',
    ];
}