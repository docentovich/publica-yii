<?php

$config = [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'sourceLanguage' => 'en',
    'language' => 'ru-RU',
    'name' => 'Publica',
    'bootstrap' => [
        'common\config\Aliases',
    ],
    'components' => [
        'urlManager'   => [
            'class'               => 'yii\web\UrlManager',
            'enablePrettyUrl'     => TRUE,
            'showScriptName'      => FALSE,
            'enableStrictParsing' => TRUE,
            'rules' => [],
            'suffix' => ''
        ],
        'errorHandler' => [
            'errorAction' => 'error-handler/error',
        ],

        'urlManagerFrontEnd' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => '/',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'jsUrlManager' => [
            'class' => \dmirogin\js\urlmanager\JsUrlManager::class,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => yii\i18n\PhpMessageSource::class,
                    'basePath' => '@src/messages',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                        'app/user' => 'user.php',
                        'app/tosee' => 'tosee.php',
                        'app/probank' => 'probank.php',
                        'app/shotme' => 'shotme.php',
                        'app/cities' => 'cities.php',
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
                'font-awesome.css' => 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
            ],
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [],
                ],
            ],
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
        ],
    ],
];

if(YII_ENV == YII_ENV_DEV){
    unset($config['components']['cache']);
}

return $config;
