<?php
namespace app\widgets\header;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class HeaderAsset extends AssetBundle
{
    public $sourcePath = '@components/widgets/header/assets';
    public $css = [
        'css/header.css',
    ];
    public $js = [
        'js/header.js',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_END];
}