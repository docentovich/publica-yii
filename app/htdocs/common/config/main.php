<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=db;dbname=tosee',
            'username' => 'root',
            'password' => 'secret',
            'charset' => 'utf8',
            'tablePrefix' => 'tbl_'
        ],
    ],
    'modules' => [
        'tosee' => [
            'class' => 'modules\tosee\Module',
        ],
        'user' => [
            'class' => 'dektrium\user\Module',
        ],
    ],

];
