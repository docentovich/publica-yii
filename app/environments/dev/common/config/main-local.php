<?php
return [
    'components' => [
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.yandex.ru',
                'username' => 'publica.mail@yandex.ru',
                'password' => 'avbva007',
                'port' => '465',
                'encryption' => 'ssl',
            ],
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=db;dbname=tosee',
            'username' => 'root',
            'password' => '1Vv4nfkCXp',
            'charset' => 'utf8',
            'tablePrefix' => 'tbl_',
        ],
    ],
    'modules' => [
        'debug' => [
            'class' => 'yii\debug\Module',
            'allowedIPs' => ['127.0.0.1', '192.168.0.*', '172.*.*.*', '10.*.*.*', '::1']
        ],
        'user' => [
            'mailer' => [
                'sender' => ['publica.mail@yandex.ru' => 'Publica']
            ],
        ],
    ]
];
