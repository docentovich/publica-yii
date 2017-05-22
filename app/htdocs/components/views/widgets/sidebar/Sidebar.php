<?
namespace components\views\widgets\sidebar;

use yii\base\Widget;

class Sidebar extends Widget
{
    public $id;
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