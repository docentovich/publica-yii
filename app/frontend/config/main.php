<?php
$params = array_merge(
    require( __DIR__ . '/../../common/config/params.php' ),
    require( __DIR__ . '/../../common/config/params-local.php' ),
    require( __DIR__ . '/params.php' ),
    require( __DIR__ . '/params-local.php' )
);

switch (PROJECT) {
    case  TOSEE:
        $domain_params = [
            'bootstrap' => [
                'tosee\Bootstrap',
                'tosee\FrontendBootstrap',
            ],
            'modules' => [
                'project' => [
                    'class' => 'tosee\Module',
                ]
            ]
        ];
        break;
    case PROBANK:
        $domain_params = [
            'bootstrap' => [
                'probank\Bootstrap',
                'probank\FrontendBootstrap',
            ],
            'modules' => [
                'project' => [
                    'class' => 'probank\Module',
                ]
            ]
        ];
        break;
    case PUBLICA:
        $domain_params = [
            'bootstrap' => [
                'publica\FrontendBootstrap',
            ],
            'modules' => [
                'project' => [
                    'class' => 'publica\Module',
                ]
            ]
        ];
        break;
}

$config = [
    'id'       => 'app-frontend',
    'basePath' => dirname( __DIR__ ),
    'homeUrl'  => '/',

    'bootstrap' => [
        'log',
        'app\templates\BootstrapFront',
        'jsUrlManager'  // need to be after all bootstrap adding rules
    ],
    'components' => [
        'errorHandler' => [
            'errorAction' => 'error-handler/error',
        ],

        'user' => [
            'loginUrl' => '/admin/user/login'
        ],

        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl'   => '',
        ],

        'session'      => [
            'name' => 'advanced',
        ],

        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => [ 'error', 'warning' ],
                ],
            ],
        ],


    ],
    'modules'    => [
        'user' => [
            // following line will restrict access to admin controller from frontend application
            'as frontend' => 'dektrium\user\filters\FrontendFilter',
        ],
        'planner' => [
            'layout' => '@current_template/layouts/main'
        ],
    ],
    'params'     => $params,
];

// return  $config ;
return yii\helpers\ArrayHelper::merge( $domain_params, $config );
