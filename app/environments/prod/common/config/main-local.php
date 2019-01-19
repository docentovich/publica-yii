<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=db;dbname=tosee',
            'username' => 'root',
            'password' => '1Vv4nfkCXp',
            'charset' => 'utf8',
            'tablePrefix' => 'tbl_',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.yandex.ru',
                'username' => 'publica.mail1@yandex.ru',
                'password' => 'avbva007',
                'port' => '465',
                'encryption' => 'ssl',
            ],
        ],
    ],
    'modules' => [
        'user' => [
            'mailer' => [
                'sender' => ['publica.mail1@yandex.ru' => 'Publica']
            ],
        ],
    ],
];
