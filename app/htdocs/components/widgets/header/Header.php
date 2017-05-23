<?
/*
 * Самая врхняя плашечка
 *
 */
namespace components\widgets\header;

use yii\base\Widget;

class Header extends Widget
{
    public $logo;

public function init()
{
    parent::init();
}

public function run()
{
    return $this->render("view", ["logo" => $this->logo]);
}
}