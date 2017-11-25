<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Team asset bundle.
 */
class TeamAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'team/team.css',
    ];
    //java -jar D:\Asset\closure.jar --js C:\xampp\htdocs\cloudteam-metronic\backend\web\team\team.js --js_output_file C:\xampp\htdocs\cloudteam-metronic\backend\web\team\team.min.js
    //java -jar D:\Asset\closure.jar --js C:\xampp\htdocs\cloudteam-metronic\backend\web\template\assets\global\scripts\app.js --js_output_file C:\xampp\htdocs\cloudteam-metronic\backend\web\template\assets\global\scripts\app.min.js
    //java -jar D:\Asset\closure.jar --js C:\xampp\htdocs\cloudteam-metronic\backend\web\template\assets\layouts\layout\scripts\layout.js --js_output_file C:\xampp\htdocs\cloudteam-metronic\backend\web\template\assets\layouts\layout\scripts\layout.min.js
}
