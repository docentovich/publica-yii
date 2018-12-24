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
                'app\modules\tosee\Bootstrap',
                'app\modules\tosee\FrontendBootstrap',
            ],
            'modules' => [
                'project' => [
                    'class' => 'app\modules\tosee\Module',
                ]
            ]
        ];
        break;
    case PROBANK:
        $domain_params = [
            'bootstrap' => [
                'app\modules\probank\Bootstrap',
                'app\modules\probank\FrontendBootstrap',
            ],
            'modules' => [
                'project' => [
                    'class' => 'app\modules\probank\Module',
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
        'app\modules\users\Bootstrap',
        'jsUrlManager'  // need to be after all bootstrap adding rules
    ],
    'components' => [
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
    ],
    'params'     => $params,
];

// return  $config ;
return yii\helpers\ArrayHelper::merge( $domain_params, $config );
