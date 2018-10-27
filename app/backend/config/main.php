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
    'bootstrap'    => [
        'log',
        \app\templates\BootstrapBackend::class,
        'app\modules\probank\BackendBootstrap',
        'app\modules\tosee\BackendBootstrap',
        'app\modules\users\Bootstrap',
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
                'settings' => 'app\modules\users\controllers\backend\UserPanelController',
            ],
            'modelMap'      => [
                'Profile'          => \app\models\Profile::class,
                'RegistrationForm' => \app\modules\users\models\RegistrationForm::class,
                'User'             => \app\models\User::class,
            ],
            'urlRules' => [
            ],
        ],
    ],
    'components' => [
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
        ],
        'urlManagerFrontEnd' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => '/',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
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
