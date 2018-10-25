<?php
/**
 * Created by PhpStorm.
 * User: AProzorov
 * Date: 25.10.2018
 * Time: 13:35
 */

namespace app\templates;


use yii\web\AssetBundle;

class ImagesLoadedAssets extends AssetBundle
{
    public $sourcePath;
    public $js = [
        'imagesloaded.js'
    ];
}