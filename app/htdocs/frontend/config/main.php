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
        $params[ 'project' ] = TOSEE;
        $domain_params = require "main-tosee.php";
        break;
    case PROBANK_DEV:
    case PROBANK_PROD :
        $params[ 'project' ] = PROBANK;
        $domain_params = require "main-probank.php";
        break;
    
}
$config = [
    'id'       => 'app-frontend',
    'basePath' => dirname( __DIR__ ),
    'homeUrl'  => '/',
    'bootstrap' => [
        'log',
        'templates\BootstrapFront',
    ],
    'components' => [
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
        //        'rbac' => 'dektrium\rbac\RbacWebModule',
    ],
    'params'     => $params,
];

return yii\helpers\ArrayHelper::merge( $domain_params, $config );
