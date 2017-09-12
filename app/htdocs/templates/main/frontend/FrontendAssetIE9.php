<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class FrontendAssetIE9 extends AssetBundle
{
    public $sourcePath = '@templates/main/frontend/assets';
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

