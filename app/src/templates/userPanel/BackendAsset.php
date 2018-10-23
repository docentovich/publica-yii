<?php

namespace app\assets;
use yii\web\AssetBundle;

class BackendAsset extends AssetBundle
{
    public $sourcePath = '@current_template/assets';
    public $css = [
        'css/main.css',
        'bundle/vendor.css',
    ];
    public $js = [
        'js/main.js',
        'bundle/vendor.js',
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_END];
    public $depends = [
        'yii\web\YiiAsset',
    ];

    public function init()
    {
        parent::init();
        // resetting BootstrapAsset to not load own css files
        \Yii::$app->assetManager->bundles['yii\web\JqueryAsset'] = [
            'js' => []
        ];
    }

}