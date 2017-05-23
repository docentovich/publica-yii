<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 23.05.2017
 * Time: 15:08
 */

namespace app\assets;
use yii\web\AssetBundle;

class BackendAsset extends AssetBundle
{
    public $sourcePath = '@templates/backend/assets';
    public $css = [
        'css/vendor.css',
        'css/mains.css',
    ];

}