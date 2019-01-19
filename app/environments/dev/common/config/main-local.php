<?php
$config = [
    'components' => [
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
            'messageConfig' => [
                'charset' => 'UTF-8',
                'from' => ['publica.suppor@gmail.com' => 'Publica'],
            ],
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'port' => '587',
                'encryption' => 'tls',
                'username' => 'publica.suppor@gmail.com',
                'password' => 'avbva007',
                'streamOptions' => [
                    'ssl' => [
                        'allow_self_signed' => true,
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                    ],
                ],
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
                'sender' => ['publica.suppor@gmail.com' => 'Publica']
            ],
        ],
    ],
    'bootstrap' => [
        'debug'
    ],
];

if (YII_ENV_DEV) {
    $config['components']['assetManager']['forceCopy'] = true;
}

return $config;
