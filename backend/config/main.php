<?php

use backend\components\Permission;
use common\models\User;
use yii\i18n\PhpMessageSource;
use yii\log\FileTarget;
use yii\web\GroupUrlRule;
use yii\web\Request;
use yii\web\UrlNormalizer;
//NOTE:Nếu có sử dụng frontend thì phải thêm $baseUrl = '/admin' vả comment homeURL
$params  = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);
$baseUrl = str_replace('/backend/web', '', (new Request)->getBaseUrl());
//$baseUrl = '/admin';
return [
    'id'                  => 'cloudteam-app-backend',
    'basePath'            => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'homeUrl'             => '/',
    'modules'             => [
        'system' => [
            'class' => \backend\modules\system\Module::class,
        ],
    ],
    'components'          => [
        'permission' => [
            'class' => Permission::class,
        ],
        'user'       => [
            'identityClass'   => User::class,
            'enableAutoLogin' => true,
            'identityCookie'  => [
                'name' => '_backendUser', // unique for backend
            ],
            'authTimeout'     => 60000
        ],
        'session'    => [
            'name'     => 'BACKENDSESSID',
            'savePath' => sys_get_temp_dir(),
        ],
        'log'        => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                '404'     => [
                    'class'      => FileTarget::class,
                    'categories' => ['yii\web\HttpException:404'],
                    'levels'     => ['error'],
                    'logFile'    => '@runtime/logs/404.log',
                    'logVars'    => ['_POST', '$_GET']
                ],
                'backend' => [
                    'class'      => \yii\log\DbTarget::class,
                    'categories' => [\yii\db\Exception::class, 'system', 'yii\swiftmailer\*', 'yii\web\HttpException:500', 'yii\base\*', 'application'],
                    'levels'     => ['error', 'info', 'warning'],
                    'logVars'    => [],
                    'logTable'   => 'syslog',
                    'prefix'     => function () {
                        $request = Yii::$app->getRequest();
                        $ip      = $request instanceof Request ? $request->getUserIP() : '-';

                        /* @var $user \yii\web\User */
                        $user   = Yii::$app->has('user', true) ? Yii::$app->get('user') : null;
	                    $userID = '-';
                        if ($user && ($identity = $user->getIdentity(false))) {
                            $userID = $identity->getId();
                        }

                        return "IP: $ip; UserId: $userID";
                    }
                ],
            ],
        ],
        'request'    => [
            'baseUrl'                => $baseUrl,
            'enableCsrfValidation'   => true,
            'enableCookieValidation' => false,
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
                [
                    'class' => GroupUrlRule::class,
                    'rules' => [
                        '/'                      => 'site/index',
                        'login'                  => 'site/login',
                        'logout'                 => 'site/logout',
                        'reset-password'         => 'site/reset-password',
                        'request-password-reset' => 'site/request-password-reset',
                    ],
                ],
                '<controller>'                                            => '<controller>/index',
                '<module:\w+>/<controller:\w+>/<action:^[a-z-]+>'         => '<module>/<controller>/index',
                '<controller:[a-z-]+>/<action:[a-z-]+>/<id:\d+>'          => '<controller>/<action>',
                '<module>/<controller:[a-z-]+>/<action:[a-z-]+>/<id:\d+>' => '<module>/<controller>/<action>',
            ],
        ],
        'i18n'       => [
            'translations' => [
                'backend' => [
                    'class'    => PhpMessageSource::class,
                    'basePath' => '@backend/messages',
                    'fileMap'  => []
                ],
            ],
        ],
        'assetManager' => [
            'appendTimestamp' => true,
        ]
    ],
    'params'              => $params,
    'aliases'             => ['@upload' => $baseUrl . '/uploads'],
];
