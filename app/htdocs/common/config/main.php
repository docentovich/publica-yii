<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'ru-RU', // 'ru-RU'
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
        'i18n' => [
            'translations' => [
                // обрабатываются источником. В нашем случае, мы обрабатываем все, что начинается с app
                'app*' => [
                    'class' => yii\i18n\PhpMessageSource::className(),
                    //
                    'basePath' => '@app/messages',
                    // исходный язык
//                    'sourceLanguage' => 'ru-RU',
                    // определяет, какой файл будет подключаться для определённой категории
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ]
                ],
                'common*' => [
                    'class' => yii\i18n\PhpMessageSource::className(),
                    //
                    'basePath' => '@app/messages',

                ],
            ],
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
