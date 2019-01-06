<?php

namespace app\widgets\header;

use yii\web\AssetBundle;

class HeaderAssets extends  AssetBundle
{
    public $sourcePath;

    public $css = [
        'css/index.css',
        'css/additional-styles.css',
    ];
    public $js = [
        'js/index.js',
        'js/additional.js',
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_END];

    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $this->sourcePath = __DIR__ . "/assets";
    }
}