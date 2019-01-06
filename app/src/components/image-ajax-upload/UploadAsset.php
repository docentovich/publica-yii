<?php

namespace ImageAjaxUpload;

use yii\web\AssetBundle;

class UploadAsset extends AssetBundle
{

    public $js = [
        'js/upload.js'
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_END];

    public function init()
    {
        parent::init();
        $this->sourcePath = __DIR__ . '/assets';
    }
}