<?
namespace modules\tosee\widgets\sidebar;

use yii\base\Widget;

/**
 * Class Sidebar Виджет сайдбара. работает по итпу миксинов
 * в $content все содержимое сайдбара
 * @package modules\tosee\widgets\sidebar
 */
class Sidebar extends Widget
{
    /**
     * @var проставляет id сайдбару для jQuery запросов
     */
    public $id;

    /**
     * @var бэм модификатор для стилизации сайбара
     */
    public $modif;

    public function init()
    {
        parent::init();
        ob_start();
    }

    public function run()
    {
        $content = ob_get_clean();
        $id = $this->id;
        $modif = $this->modif;
        return $this->render("view", compact('content', 'id', 'modif'));
    }
}