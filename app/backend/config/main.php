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
        'app\templates\BootstrapBackend',
        'probank\Bootstrap',
        'probank\BackendBootstrap',
        'tosee\Bootstrap',
        'tosee\BackendBootstrap',
        'shootme\Bootstrap',
        'shootme\BackendBootstrap',
        'jsUrlManager'  // need to be after all bootstrap adding rules
    ],
    'modules' => [
        'probank' => [
            'class' => 'probank\Module',
        ],
        'tosee'   => [
            'class' => 'tosee\Module',
        ],
        'shootme'   => [
            'class' => 'shootme\Module',
        ],
        'planner' => [
            'layout' => '@userPanelTemplate/layouts/user'
        ],
    ],
    'components' => [
        'errorHandler' => [
            'errorAction' => 'error-handler/error',
        ],

        'request' => [
            'csrfParam' => '_csrf-backend',
            'baseUrl'   => '/admin',
        ],
        'session' => [
            'name' => 'advanced',
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
