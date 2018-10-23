<?php
namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class FrontendAsset extends AssetBundle
{
    public $sourcePath;
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

    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $this->sourcePath = "@templates/tosee/assets";
    }

    public function init()
    {
        parent::init();
        // resetting BootstrapAsset to not load own css files
        \Yii::$app->assetManager->bundles['yii\web\JqueryAsset'] = [
            'js' => []
        ];
    }
}