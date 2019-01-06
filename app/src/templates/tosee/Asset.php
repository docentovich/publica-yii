<?php
namespace app\templates\tosee;

use app\assets\DatePickerAsset;
use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class Asset extends AssetBundle
{
    public $sourcePath  = "@templates/tosee/assets";
    public $css = [
        'css/tosee.css',
        'css/additional-styles.css',
    ];
    public $js = [
        'js/main.js',
        'js/additional.js',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_END];
    public $depends = [
        'yii\web\YiiAsset',
        DatePickerAsset::class,
        'app\assets\ImagesLoadedAsset',
        'app\assets\FontAwesomeAsset',
        'app\assets\SharerAsset',
        'app\templates\CommonAsset'
    ];

}