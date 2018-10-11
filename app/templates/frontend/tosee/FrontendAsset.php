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
        'css/vendor.css',
        // 'css/main.css',
    ];
    public $js = [
        'js/vendor.js',
        // 'js/main.js',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_END];
    public $depends = [
        'yii\web\YiiAsset',
    ];

    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $this->sourcePath = __DIR__ . "/assets'";
    }

    public function registerAssetFiles( $view )
    {

        $this->css[] = "css/main.css";
        $this->js[] = "js/main.js";
        
        parent::registerAssetFiles( $view );
    }
}