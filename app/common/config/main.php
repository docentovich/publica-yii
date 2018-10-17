<?php

switch (PROJECT) {
    case  TOSEE:
        $domain_params = [
            'bootstrap' => [
                'app\modules\tosee\Bootstrap',
            ],
        ];
        break;
    case PROBANK:
        $domain_params = [
            'bootstrap' => [
                'app\modules\probank\Bootstrap',
            ],
        ];
        break;
}

$config = [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'ru-RU',
    'name' => 'Publica',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
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
                    ],
                ],
                'post*' => [
                    'class' => yii\i18n\PhpMessageSource::className(),
                    'basePath' => 'messages',
                    'sourceLanguage' => 'en',
                    'fileMap' => [
                        'app/post' => 'post.php',
                    ],
                ],
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'assetManager' => [
            'dirMode' => 0777,
        ]
    ],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
        ],
    ],
];

if (YII_ENV_DEV) {
    $config['components']['assetManager']['forceCopy'] = true;
}
return yii\helpers\ArrayHelper::merge($domain_params, $config);
