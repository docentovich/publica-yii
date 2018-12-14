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
        'app\modules\tosee\Bootstrap',
        'app\modules\tosee\BackendBootstrap',
        'app\modules\users\Bootstrap',
        'jsUrlManager'  // need to be after all bootstrap adding rules
    ],
    'modules' => [
        'probank' => [
            'class' => 'app\modules\probank\Module',
        ],
        'tosee'   => [
            'class' => 'app\modules\tosee\Module',
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
        // вьюшки дектриума
        'view'       => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views' => '@modules/users/views',
                ],
            ],
        ],
    ],
    'params'     => $params,
];
