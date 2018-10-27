<?php
/**
 * Created by PhpStorm.
 * User: docen
 * Date: 10/27/2018
 * Time: 12:20 AM
 */

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