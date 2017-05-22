<?php
namespace modules\tosee\assets\frontend;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $sourcePath = '@modules/tosee/views/frontend/assets';
    public $css = [
        'css/vendor.css',
        'css/main.css',
    ];
    public $js = [
        'js/vendor.js',
        'js/main.js',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_END];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}