<?php


return [
    'vendorPath' => dirname( dirname( __DIR__ ) ) . '/vendor',
    'language'   => 'ru-RU',
    'name'       => 'Publica',
    'components' => [
        'cache'        => [
            'class' => 'yii\caching\FileCache',
        ],

        'i18n'         => [
            'translations' => [
                'app*'  => [
                    'class'          => yii\i18n\PhpMessageSource::className(),
                    'basePath'       => 'messages',
                    'sourceLanguage' => 'en',
                    'fileMap'        => [
                        'app'       => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
                'post*' => [
                    'class'          => yii\i18n\PhpMessageSource::className(),
                    'basePath'       => 'messages',
                    'sourceLanguage' => 'en',
                    'fileMap'        => [
                        'app/post' => 'post.php',
                    ],
                ],
            ],
        ],
        
        'authManager'  => [
            'class' => 'yii\rbac\DbManager',
        ],
        
        'assetManager' => [
            'dirMode' => 0777,
        ],
        
    ],
    
    'modules'   => [
        'tosee' => [
            'class' => 'modules\tosee\Module',
        ],
        'probank' => [
            'class' => 'modules\probank\Module',
        ],
        'user'  => [
            'class' => 'dektrium\user\Module',
        ],
    ],
];
