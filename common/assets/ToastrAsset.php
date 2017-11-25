<?php

namespace common\assets;

use yii\web\AssetBundle;

class ToastrAsset extends AssetBundle
{
    public $sourcePath = '@bower/toastr';
    public $js = [
        'toastr.min.js'
    ];
    public $css = [
        'toastr.min.css'
    ];
}