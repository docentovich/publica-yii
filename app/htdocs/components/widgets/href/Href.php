<?php namespace components\widgets\href;

use yii\base\Widget;
use yii\bootstrap\Html;

/**
 * Обертка для ссылки. Аля миксин
 *
 * Class Href
 * @package components\widgets\href
 */
class Href extends Widget
{
    public $url;
    public $params;

    public function init()
    {
        parent::init();
        ob_start();
    }

    public function run()
    {
        $content = ob_get_clean();
        return Html::a($content, $this->url, $this->params);
    }
}