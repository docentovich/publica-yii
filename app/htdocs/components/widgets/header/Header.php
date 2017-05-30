<?
namespace components\widgets\header;

use yii\base\Widget;

/**
 * Самая врхняя плашечка
 *
 * Class Header
 * @package components\widgets\header
 */
class Header extends Widget
{
    /**
     * @var url логотипа плашки
     */
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