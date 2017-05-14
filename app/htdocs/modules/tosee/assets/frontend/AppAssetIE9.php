<?php

namespace modules\tosee\assets\frontend;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAssetIE9 extends AssetBundle
{
    public $basePath = '@webroot/assets';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        "/libs/ie/html5shiv.js",
        "/libs/ie/respond.src.js",
        "/libs/ie/respond.matchmedia.addListener.src.js",
        "/libs/polyfills/background_size_emu.js",
    ];
    public $jsOptions = ['condition' => 'lte IE9'];
    
}
