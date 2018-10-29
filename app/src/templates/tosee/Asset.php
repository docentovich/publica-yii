<?php
namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class Asset extends AssetBundle
{
    public $sourcePath  = "@templates/tosee/assets";
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
        'app\assets\ImagesLoadedAsset',
        'app\assets\FontAwesomeAsset',
    ];

}