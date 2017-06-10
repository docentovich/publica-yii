<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'homeUrl' => '/admin',
    'defaultRoute' => '/user/settings/profile',
    'bootstrap' => [
        'log',
    ],
    'modules' => [
        'tosee' => [
            'isBackend' => true,
        ],
        'user' => [
            'class' => 'dektrium\user\Module',
//            'as backend' => [
//                'class' => 'dektrium\user\filters\BackendFilter',
//                'controllers' => ['profile', 'recovery', 'settings']
//            ],

            'layout' => '@templates/main/backend/layouts/main',
            'controllerMap' => [
                'security' => [
                    'class' => 'dektrium\user\controllers\SecurityController',
                    'layout' => '@templates/main/backend/layouts/login',
                ],
                'registration' => [
                    'class' => 'modules\users\controllers\backend\RegistrationController',
                    'layout' =>     '@templates/main/backend/layouts/login',
                ],
                'recovery' => [
                    'class' => 'dektrium\user\controllers\RecoveryController',
                    'layout' =>     '@templates/main/backend/layouts/login',
                ],

                'settings' =>  'modules\users\controllers\backend\UserpanelController',

            ],
            'modelMap' => [
                'Profile' => 'common\models\Profile',
                'RegistrationForm' => 'modules\users\models\RegistrationForm',
//                'User' => 'modules\users\models\User',
            ],

            'urlRules' => [

            ],
        ],
//        'rbac' => 'dektrium\rbac\RbacWebModule',
    ],

    'components' => [
//        'errorHandler' => [
//            'errorAction' => 'tosee/site/error',
//        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
            'baseUrl' => '/admin',

        ],

        'session' => [
            'name' => 'advanced',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],


        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' =>[
                '<_c:(author|moderator|director)>'                      => '/tosee/<_c>/index',
                '<_c:(author|moderator|director)>/<_a:[a-zA-Z\-\_]+>'   => '/tosee/<_c>/<_a>',
                'avatar-upload'                                         => '/user/settings/upload-avatar',
                '<action:[\w\-]+>'                                      => '/user/settings/<action>',

            ]

        ],

        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views' => '@modules/users/views/backend',
                ],
            ],
        ],


    ],
    'params' => $params,

];
