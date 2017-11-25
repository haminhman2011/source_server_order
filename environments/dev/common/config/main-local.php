<?php

use yii\swiftmailer\Mailer;

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=metronic',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'mailer' => [
	        'class'            => Mailer::class,
	        'viewPath'         => '@common/mail',
	        'useFileTransport' => false,
	        'transport'        => [
		        'class'      => \Swift_SmtpTransport::class,
		        'host'       => 'smtp.gmail.com',
		        'username'   => 'hexyclone@gmail.com',
		        'password'   => 'hexy0206',
		        'port'       => 465,
		        'encryption' => 'ssl',
		        'timeout'    => 60 //in second
	        ],
        ],
    ],
];
