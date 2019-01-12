<?php

namespace app\widgets\bgimg;

use yii\web\AssetBundle;

class Asset extends AssetBundle
{
    public $css = ['css/main.css'];
    public function init()
    {
        $this->sourcePath = __DIR__ . "/assets";
    }
}