<?php
$params = array_merge(
    require( __DIR__ . '/../../common/config/params.php' ),
    require( __DIR__ . '/../../common/config/params-local.php' ),
    require( __DIR__ . '/params.php' ),
    require( __DIR__ . '/params-local.php' )
);

return [
    'id'           => 'app-backend',
    'basePath'     => dirname( __DIR__ ),
    'homeUrl'      => '/admin',
    'defaultRoute' => '/user/settings/profile',
    'bootstrap'    => [
        'log',
        \app\templates\BootstrapBackend::class,
        'app\modules\probank\BackendBootstrap',
        'app\modules\tosee\BackendBootstrap',
    ],
    'modules' => [

        'probank' => [
            'class' => 'app\modules\probank\Module',
        ],
        'tosee'   => [
            'class' => 'app\modules\tosee\Module',
        ],
        'user'  => [
            'class' => 'dektrium\user\Module',
            //            'as backend' => [
            //                'class' => 'dektrium\user\filters\BackendFilter',
            //                'controllers' => ['profile', 'recovery', 'settings']
            //            ],

            'layout'        => '@current_template/layouts/main',

            'controllerMap' => [
                'security'     => [
                    'class'  => 'dektrium\user\controllers\SecurityController',
                    'layout' => '@current_template/layouts/login',
                ],
                'registration' => [
                    'class'  => 'app\modules\users\controllers\backend\RegistrationController',
                    'layout' => '@current_template/layouts/login',
                ],
                'recovery'     => [
                    'class'  => 'dektrium\user\controllers\RecoveryController',
                    'layout' => '@current_template/layouts/login',
                ],
                'settings' => 'app\modules\users\controllers\backend\UserpanelController',
            ],
            'modelMap'      => [
                'Profile'          => \common\models\Profile::class,
                'RegistrationForm' => \app\modules\users\models\RegistrationForm::class,
                'User'             => \common\models\User::class,
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
            'baseUrl'   => '/admin',
        ],
        'session' => [
            'name' => 'advanced',
        ],
        'log'     => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => [ 'error', 'warning' ],
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => TRUE,
            'showScriptName'  => FALSE,
            // 'rules'           => [
            //
            //     'avatar-upload'                                       => '/user/settings/upload-avatar',
            //     '<action:[\w\-]+>'                                    => '/user/settings/<action>',
            // ],
        ],
        // вьюшки дектриума
        'view'       => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views' => '@modules/users/html/backend/views',
                ],
            ],
        ],
    ],
    'params'     => $params,
];
