<?php

namespace common\assets;

use yii\web\AssetBundle;

class BootboxAsset extends AssetBundle
{
    public $sourcePath = '@npm/bootbox';
    public $js = [
        'bootbox.min.js'
    ];
}