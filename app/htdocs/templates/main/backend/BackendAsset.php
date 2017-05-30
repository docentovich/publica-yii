<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 23.05.2017
 * Time: 15:08
 */

namespace templates\main\backend;
use yii\web\AssetBundle;

class BackendAsset extends AssetBundle
{
    public $sourcePath = '@templates/main/backend/assets';
    public $css = [
        'css/vendor.css',
        'css/main.css',
    ];
    public $js = [
//        'js/vendor.js',
        'js/main.js',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_END];
    public $depends = [
        'yii\web\YiiAsset',
    ];

}