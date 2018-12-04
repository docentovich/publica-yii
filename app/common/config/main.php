<?php

$config = [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'sourceLanguage' => 'en',
    'language' => 'ru-RU',
    'name' => 'Publica',
    'bootstrap' => [
        'common\config\Aliases'
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => yii\i18n\PhpMessageSource::className(),
                    'basePath' => '@src/messages',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                        'app/user' => 'user.php',
                        'app/tosee' => 'tosee.php',
                        'app/probank' => 'probank.php',
                        'app/shotme' => 'shotme.php',
                    ],
                ]
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'assetManager' => [
            'dirMode' => 0777,
            'assetMap' => [
                'jquery.js' => 'https://code.jquery.com/jquery-2.2.4.min.js',
                'imagesloaded.js' => 'https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js',
                'div-datepicker.js' => 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js',
                'div-datepicker-ru.js' => 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.ru.min.js',
                'font-awesome.css' => 'https://use.fontawesome.com/releases/v5.3.1/css/all.css',
            ],
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [],
                ],
            ],
        ],
        'postService' => [
            'class' => 'app\modules\tosee\services\PostService'
        ],
        'userService' => [
            'class' => 'app\modules\users\services\UserService'
        ],
    ],
    'modules' => [
        'user' => [
            'enableUnconfirmedLogin' => true,
            'class' => 'app\modules\users\Module',
        ],
    ],
];

return $config;
