<?php
namespace components\widgets\userpanel;

use common\models\Profile;
use yii\base\Widget;

/**
 * Юзерпанель
 *
 * Class Href
 * @package components\widgets\href
 */
class Userpanel extends Widget
{
    public $profile;

    public function init()
    {
        parent::init();
        $this->profile = Profile::find()->where(["=","user_id",\Yii::$app->user->identity->getId()])->one();
    }

    public function run()
    {
        return $this->render('view', ["image" => $this->profile->image, "name" => $this->profile->name]);
    }
}