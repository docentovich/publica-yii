<?php
namespace app\templates;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class CommonAsset extends AssetBundle
{
    public $sourcePath  = "@templates/common-assets";
    public $css = [
        'bundle/vendor.css',
        'css/common.css',
    ];
    public $js = [
        'bundle/vendor.js',
        'js/common.js',
        'js/additional.js',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_END];
    public $depends = [
        'yii\web\YiiAsset',
    ];

}