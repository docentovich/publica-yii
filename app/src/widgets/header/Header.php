<?php

namespace app\widgets\header;

use yii\base\Widget;
use yii\web\AssetBundle;

/**
 * Самая врхняя плашечка
 *
 * Class Header
 * @package app\widgets\header
 */
class Header extends Widget
{
    /**
     * @var AssetBundle;
     */
    public $bundle;

    public function init()
    {
        parent::init();
        ob_start();
    }

    public function run()
    {
        $content = ob_get_clean();

        return $this->render("view", [
            "content" => $content,
            "bundle" => $this->bundle
        ]);
    }
}