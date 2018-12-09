<?php

namespace app\widgets;

use yii\web\AssetBundle;

class PictureAsset extends AssetBundle
{
    public $js = [
        'picture.js',
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_END];

    public $depends = [
        'yii\web\YiiAsset',
    ];

    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $this->sourcePath = __DIR__ . "/assets";
    }
}