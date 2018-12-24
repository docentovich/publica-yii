<?php

namespace app\templates\tosee;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AssetIE9 extends AssetBundle
{
    public $sourcePath = __DIR__ . '/assets';
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

