<?php
use common\models\User;
use yii\i18n\PhpMessageSource;
use yii\log\FileTarget;
use yii\web\UrlNormalizer;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id'                  => 'app-frontend',
    'homeUrl'             => '/',
    'basePath'            => dirname(__DIR__),
    'bootstrap'           => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components'          => [
        'request'    => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl'   => '',
        ],
        'user'       => [
            'identityClass'   => User::class,
            'enableAutoLogin' => true,
            'identityCookie'  => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session'    => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'FRONTENDSESSID',
        ],
        'log'        => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                '404' => [
                    'class'      => FileTarget::class,
                    'categories' => ['yii\web\HttpException:404'],
                    'levels'     => ['error'],
                    'logFile'    => '@runtime/logs/404.log',
                    'logVars'    => ['_POST', '$_GET']
                ],
                'app' => [
                    'class'      => \yii\log\DbTarget::class,
                    'categories' => [\yii\db\Exception::class, 'system', 'yii\swiftmailer\*', 'yii\web\HttpException:500'],
                    'levels'     => ['error', 'warning', 'info'],
                    'logVars'    => [],
                    'logTable'   => 'syslog'
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'normalizer'      => [
                'class'                  => UrlNormalizer::class,
                'collapseSlashes'        => true,
                'normalizeTrailingSlash' => true,
                'action'                 => UrlNormalizer::ACTION_REDIRECT_TEMPORARY,// use temporary redirection instead of permanent for debugging
            ],
            'rules'           => [
                '<controller:[a-z-]+>/<action:[a-z-]+>/<id:\d+>' => '<controller>/<action>',
            ],
        ],
        'i18n'       => [
            'translations' => [
                'frontend' => [
                    'class'    => PhpMessageSource::class,
                    'basePath' => '@frontend/messages',
                    'fileMap'  => []
                ],
            ],
        ],
    ],
    'params'              => $params,
];
