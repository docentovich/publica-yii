<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 23.05.2017
 * Time: 15:08
 */

namespace app\assets;
use yii\web\AssetBundle;

class BackendAsset extends AssetBundle
{
    public $sourcePath = '@templates/main/backend/assets';
    public $css = [
        'css/vendor.css',
        'css/main.css',
    ];
    public $js = [
        'js/vendor.js',
        'js/main.js',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_BEGIN];
    public $depends = [
        'yii\web\YiiAsset',
    ];

}