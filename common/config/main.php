<?php
use backend\assets\TeamAsset;
use common\utils\helpers\Security;
use yii\bootstrap\BootstrapAsset;
use yii\bootstrap\BootstrapPluginAsset;
use yii\caching\FileCache;
use yii\i18n\PhpMessageSource;
use yii\web\JqueryAsset;
use yii\web\YiiAsset;

return [
    'name'       => 'My YII',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'timeZone'   => 'Asia/Ho_Chi_Minh',
    'components' => [
        'cache'        => [
            'class' => FileCache::class,
        ],
        'i18n'         => [
            'translations' => [
                'yii' => [
                    'class'    => PhpMessageSource::class,
                    'basePath' => '@common/messages',
                    'fileMap'  => []
                ],
                'number' => [
                    'class'    => PhpMessageSource::class,
                    'basePath' => '@common/messages',
                    'fileMap'  => []
                ],
                'date' => [
                    'class'    => PhpMessageSource::class,
                    'basePath' => '@common/messages',
                    'fileMap'  => []
                ],
            ],
        ],
        'formatter'    => [
            'dateFormat'        => 'php:d-m-Y',
            'datetimeFormat'    => 'php:d-m-Y H:i:s',
            'timeFormat'        => 'H:i:s',
            'locale'            => 'vi',
            'defaultTimeZone'   => 'Asia/Ho_Chi_Minh',
            'decimalSeparator'  => '.',
            'thousandSeparator' => ',',
            'currencyCode'      => 'VND',
            'sizeFormatBase'    => 1000,
            'nullDisplay'       => ''
        ],
        'assetManager' => [
            'bundles'         => [
	            JqueryAsset::class          => [
                    'js' => [
                        'jquery-3.2.1.min.js'
                    ]
                ],
	            YiiAsset::class             => [
                    'jsOptions' => [
                        'position' => \yii\web\View::POS_HEAD,
                    ],
                ],
	            BootstrapPluginAsset::class => [
                    'jsOptions' => ['position' => \yii\web\View::POS_HEAD],
                    'js'        => [
                        'js/bootstrap.min.js'
                    ],
                ],
	            BootstrapAsset::class       => [
		            'jsOptions' => [ 'position' => \yii\web\View::POS_HEAD ],
		            'css'       => [
			            'css/bootstrap.min.css'
		            ],
	            ],
	            TeamAsset::class            => [
                    'jsOptions' => ['defer' => 'defer'],
                    'js'        => [
                        'team/lodash.min.js',
                        YII_ENV_DEV ? 'team/team.js' : 'team/team.min.js',
                    ]
                ],
            ],
            'appendTimestamp' => true,
        ],
        'security'     => [
            'class'                => Security::class,
            'passwordHashStrategy' => 'password_hash',
            'authKeyInfo'          => 'CloudTeam',
            'kdfHash'              => 'sha384',
            'macHash'              => 'sha384',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'language'   => 'vi'
];
