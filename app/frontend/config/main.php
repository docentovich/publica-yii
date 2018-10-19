<?php
$params = array_merge(
    require( __DIR__ . '/../../common/config/params.php' ),
    require( __DIR__ . '/../../common/config/params-local.php' ),
    require( __DIR__ . '/params.php' ),
    require( __DIR__ . '/params-local.php' )
);

switch ( $_SERVER[ 'SERVER_NAME' ] ) {
    case  TOSEE_DEV:
    case  TOSEE_PROD:
        $domain_params = require "main-tosee.php";
        break;
    case PROBANK_DEV:
    case PROBANK_PROD :
        $domain_params = require "main-probank.php";
        break;
}


$config = [
    'id'       => 'app-frontend',
    'basePath' => dirname( __DIR__ ),
    'homeUrl'  => '/',

    'defaultRoute' => 'project/site/index',

    'bootstrap' => [
        'log',
        'app\templates\BootstrapFront',
        'app\modules\users\Bootstrap',
    ],
    'components' => [
        'errorHandler' => [
            'errorAction' => 'project/site/error',
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

        'urlManager'   => [
            'class'               => 'yii\web\UrlManager',
            'enablePrettyUrl'     => TRUE,
            'showScriptName'      => FALSE,
            'enableStrictParsing' => TRUE,
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
