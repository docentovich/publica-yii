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
                'app*' => [
                    'class' => yii\i18n\PhpMessageSource::className(),
                    'basePath' => 'messages',
                    'sourceLanguage' => 'en',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ]
                ],
                'post*' => [
                    'class' => yii\i18n\PhpMessageSource::className(),
                    'basePath' => 'messages',
                    'sourceLanguage' => 'en',
                    'fileMap' => [
                        'app/post' => 'post.php',
                    ]
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
