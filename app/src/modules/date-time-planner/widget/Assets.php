<?php

namespace DateTimePlanner\widget;

use app\assets\DatePickerAsset;
use yii\web\AssetBundle;
use yii\web\View;

class Assets extends AssetBundle
{
    public $sourcePath  = "@DateTimePlanner/widget/assets";
    public $js = [
        'time-planner.js'
    ];
    public $css = [
        'additional.css'
    ];
    public $jsOptions = ['position' => View::POS_END];
    public $depends = [
        DatePickerAsset::class
    ];
}