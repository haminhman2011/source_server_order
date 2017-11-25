<?php
use yii\gii\Module;

$config = [
	'components' => [
		'request' => [
			// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
			'cookieValidationKey' => '',
		],
	],
];

if (YII_DEBUG) {
	$config['bootstrap'][]      = 'debug';
	$config['modules']['debug'] = [
		'class' => \yii\debug\Module::class,
	];
}

if (YII_ENV == 'dev') {
	// configuration adjustments for 'dev' environment
	$config['bootstrap'][]    = 'gii';
	$config['modules']['gii'] = [
		'class' => Module::class,
	];
}

return $config;
