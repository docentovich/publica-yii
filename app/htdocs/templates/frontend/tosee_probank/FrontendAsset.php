<?php
namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class FrontendAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/assets';
    public $css = [
        'css/vendor.css',
        // 'css/main.css',
    ];
    public $js = [
        'js/vendor.js',
        'js/main.js',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_END];
    public $depends = [
        'yii\web\YiiAsset',
    ];
    
    public function registerAssetFiles( $view )
    {
        $temp =  ( \Yii::$app->params['project'] === TOSEE ) ? "main-tosee.css" : "main-probank.css";
        $this->css[] = "css/" . $temp;
        parent::registerAssetFiles( $view );
    }
}