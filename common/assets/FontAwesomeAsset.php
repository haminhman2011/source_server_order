<?php

namespace common\assets;

use yii\web\AssetBundle;

class FontAwesomeAsset extends AssetBundle
{
    public $sourcePath = '@bower/fontawesome';
    public $jsOptions = [
        'defer' => 'defer'
    ];
    public $css = [
        'css/font-awesome.min.css'
    ];
}