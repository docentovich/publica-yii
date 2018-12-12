<?php

$config = [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'sourceLanguage' => 'en',
    'language' => 'ru-RU',
    'name' => 'Publica',
    'bootstrap' => [
        'common\config\Aliases',
        'jsUrlManager'
    ],
    'components' => [
        'jsUrlManager' => [
            'class' => \dmirogin\js\urlmanager\JsUrlManager::class,
            'configurationStringPosition' => \yii\web\View::POS_END,
        ],
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
        'imagesService' => [
            'class' => 'app\modules\tosee\services\ImagesService'
        ],
        'userService' => [
            'class' => 'app\modules\users\services\UserService'
        ],
    ],
    'modules' => [
        'user'  => [
            'class' => 'app\modules\users\Module',
            'enableUnconfirmedLogin' => true,
            'layout'        => '@current_template/layouts/user',
            'modelMap'      => [
                'Profile'          => \app\models\Profile::class,
                'RegistrationForm' => \app\modules\users\models\RegistrationForm::class,
                'User'             => \app\models\User::class,
            ],
            'urlRules' => [
            ],
        ],
    ],
];

if(YII_ENV == YII_ENV_DEV){
    unset($config['components']['cache']);
}

return $config;
