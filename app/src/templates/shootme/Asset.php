<?php
namespace app\templates\shootme;

use app\assets\DatePickerAsset;
use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class Asset extends AssetBundle
{
    public $sourcePath  = "@templates/shootme/assets";
    public $css = [
        'css/shootme.css',
        'css/additinal-styles.css',
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