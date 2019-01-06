<?php

namespace app\templates\userPanel;
use yii\web\AssetBundle;

class Asset extends AssetBundle
{
    public $sourcePath = '@current_template/assets';
    public $css = [
        'css/user-panel.css',
        'css/additional-styles.css',
        'css/tables.css',
    ];
    public $js = [
        'js/main.js',
        'js/additional.js',
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_END];
    public $depends = [
        'yii\web\YiiAsset',
        'app\assets\ImagesLoadedAsset',
        'app\assets\FontAwesomeAsset',
        'app\templates\CommonAsset'
    ];

}