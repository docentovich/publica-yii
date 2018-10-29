<?php

namespace app\templates;


use yii\web\AssetBundle;

class ImagesLoadedAsset extends AssetBundle
{
    public $sourcePath;
    public $js = [
        'imagesloaded.js'
    ];
}