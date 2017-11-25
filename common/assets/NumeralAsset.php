<?php

namespace common\assets;

use yii\web\AssetBundle;

class NumeralAsset extends AssetBundle
{
    public $sourcePath = '@bower/numeral';
    public $js = [
        'min/numeral.min.js',
//        'min/locales.min.js'
    ];
    public $jsOptions = [
        'defer' => 'defer'
    ];
}