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
                'Profile' => 'modules\users\models\Profile',
//                'User' => 'modules\users\models\User',
            ],

            'urlRules' => [
//                'upload'                     => 'upload',
                //'profile/<username:\w+>'                    => 'profile/show',
                //'profile/upload'                            => 'profile/imagesUpload',
                //'<action:(login|logout)>'                   => 'security/<action>',
                //'<action:(register|resend)>'                => 'registration/<action>',
                //'confirm/<id:\d+>/<code:[A-Za-z0-9_-]+>'    => 'registration/confirm',
                //'forgot'                                    => 'recovery/request',
                //'recover/<id:\d+>/<code:[A-Za-z0-9_-]+>'    => 'recovery/reset',
                //'settings/<action:\w+>'                     => 'settings/<action>',
            ],
        ],
        'rbac' => 'dektrium\rbac\RbacWebModule',

    ],

    'components' => [
//        'errorHandler' => [
//            'errorAction' => 'tosee/site/error',
//        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
            'baseUrl' => '/admin',

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


        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' =>[
                'editor'   => '/tosee/post/index',
                'moderator'   => '/tosee/site/moderator',
                'director'   => '/tosee/site/director',
                '/user/upload'    => '/user/settings/upload',
                '/post/main-upload'    => '/tosee/post/main-upload',
                '/post/additional-upload'    => '/tosee/post/addition-upload',
            ]

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
