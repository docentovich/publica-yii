<?php
namespace components\widgets\sidebar;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class SidebarAssets extends AssetBundle
{
    public $sourcePath = '@components/widgets/sidebar/assets';
    public $css = [
        'css/sidebar.css',
    ];

    public $js = [
        'js/sidebar.js'
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_END];
}