<?php

$config = [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'sourceLanguage' => 'en',
    'language' => 'ru-RU',
    'name' => 'Publica',
    'bootstrap' => [
        'users\Bootstrap',
        'DateTimePlanner\Bootstrap',
        'orders\Bootstrap',
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
                'sharer.js' => 'https://cdn.jsdelivr.net/npm/sharer.js@latest/sharer.min.js',
                'datepicker.css' => 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css',
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
            'class' => 'users\Module',
            'enableUnconfirmedLogin' => true,
            'layout'        => '@current_template/layouts/user',
            'modelMap'      => [
                'Profile'          => \users\models\UsersProfile::class,
                'RegistrationForm' => \users\models\RegistrationForm::class,
                'User'             => \users\models\UsersUser::class,
            ],
        ],
        'planner' => [
            'class' => 'DateTimePlanner\Module'
        ],
        'orders' => [
            'class' => 'orders\Module'
        ],
    ],
    'controllerMap' => [
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationNamespaces' => [
                'src\migrations',
                'users\migrations',
                'tosee\migrations',
                'probank\migrations',
                'DateTimePlanner\migrations',
                'orders\migrations',
            ],
        ],
    ],
];

if(YII_ENV == YII_ENV_DEV){
    unset($config['components']['cache']);
}

return $config;
