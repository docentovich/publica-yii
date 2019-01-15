<?php
namespace app\templates\publica;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class Asset extends AssetBundle
{
    public $sourcePath  = "@templates/publica/assets";
    public $css = [
        'css/publica.css',
    ];
    public $js = [
        'js/main.js',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_END];
    public $depends = [
        'yii\web\YiiAsset',
        'app\assets\FontAwesomeAsset',
        'app\templates\CommonAsset'
    ];

}