<?php

namespace app\assets;
use yii\web\AssetBundle;

class Asset extends AssetBundle
{
    public $sourcePath = '@current_template/assets';
    public $css = [
        'css/main.css',
        'css/additional-styles.css',
        'css/tables.css',
        'css/base.css',
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