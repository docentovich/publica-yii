<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=xemwxydu_publica',
            'username' => 'xemwxydu_publica',
            'password' => 'avbva007',
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
                'username' => 'publica.mail@yandex.ru',
                'password' => 'avbva007',
                'port' => '465',
                'encryption' => 'ssl',
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
        ],
    ],
    'modules' => [
        'user' => [
            'mailer' => [
                'sender' => ['publica.mail@yandex.ru' => 'Publica']
            ],
        ],
    ],
];
