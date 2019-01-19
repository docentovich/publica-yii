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
            'messageConfig' => [
                'charset' => 'UTF-8',
                'from' => ['publica.mail1@yandex.ru' => 'Publica'],
            ],
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'ssl://smtp.yandex.com',
                'username' => 'publica.mail1@yandex.ru',
                'password' => 'avbva007',
                'port' => '465',
                'streamOptions' => [
                    'ssl' => [
                        'allow_self_signed' => true,
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                    ],
                ],
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
