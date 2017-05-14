<?
/*
 * Самая врхняя плашечка
 *
 */
namespace app\components;

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