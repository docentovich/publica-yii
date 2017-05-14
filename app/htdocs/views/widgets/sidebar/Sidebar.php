<?
namespace app\components;

use yii\base\Widget;

class Sidebar extends Widget
{
    public $id;

    public function init()
    {
        parent::init();
        ob_start();
    }

    public function run()
    {
        $content = ob_get_clean();
        $id = $this->id;
        return $this->render("view", compact('content', 'id'));
    }
}