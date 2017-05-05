<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=db;dbname=tosee',
            'username' => 'root',
            'password' => 'secret',
            'charset' => 'utf8',
            'tablePrefix' => 'tbl_'
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],

    "modules" => [
        'debug' => [
            'allowedIPs' => ['127.0.0.1', '::1', '192.168.*.*'],
        ],
        'gii' => [
            'allowedIPs' => ['127.0.0.1', '::1', '192.168.*.*'],
        ]
    ]
];
