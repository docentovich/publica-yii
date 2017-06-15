<?php
return [
    'components' => [
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@app/mailer',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.mailtrap.io',
                'username' => '19c6e4ea034778',
                'password' => '929b6ae9dbc93e',
                'port' => '2525',
                'encryption' => 'tls',
            ],
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=db;dbname=tosee',
            'username' => 'root',
            'password' => '1Vv4nfkCXp',
            'charset' => 'utf8',
        ],
    ],
    'modules' => [
        'debug' => [
            'class' => 'yii\debug\Module',
            'allowedIPs' => ['127.0.0.1', '192.168.0.*', '::1']
        ]
    ]
];
