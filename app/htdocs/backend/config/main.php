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
//    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => [
        'log',
//        'modules\tosee\Bootstrap',
    ],
    'modules' => [
        'tosee' => [
            'isBackend' => true,
        ],
        'user' => [
            // following line will restrict access to profile, recovery, registration and settings controllers from backend
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
                    'class' => 'dektrium\user\controllers\RegistrationController',
                    'layout' =>     '@templates/main/backend/layouts/login',
                ],
                'recovery' => [
                    'class' => 'dektrium\user\controllers\RecoveryController',
                    'layout' =>     '@templates/main/backend/layouts/login',
                ],
                'settings' =>  'modules\users\controllers\backend\UserpanelController',

            ],
            'modelMap' => [
                'Profile' => 'modules\users\models\Profile',
//                'User' => 'modules\users\models\User',
            ],
        ],
        'rbac' => 'dektrium\rbac\RbacWebModule',

    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
//        'user' => [
//            'identityClass' => 'common\models\User',
//            'enableAutoLogin' => true,
//            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
//        ],
//        'user' => [
//            'loginUrl' => ['site/login'],
//        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        'errorHandler' => [
            'errorAction' => 'tosee/site/error',
        ],
        'request' => [
            'baseUrl' => '/admin',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],

        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views' => '@modules/users/views/backend/site',
//                    '@dektrium/user/views/' => '@templates/main/backend/views'
                ],
            ],
        ],


    ],
    'params' => $params,
//    'layoutPath' => '@templates/main/backend/layouts',
//    'layout' => 'main',

];
