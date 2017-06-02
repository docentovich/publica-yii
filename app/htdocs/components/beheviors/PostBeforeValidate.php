<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 02.06.17
 * Time: 20:08
 */

namespace components\beheviors;
use yii\base\Behavior;
use common\models\User;
use yii\db\ActiveRecord;


/**
 * Забираем город у текщего юзера
 *
 * Class PostBeforeValidate
 * @package components\beheviors
 */
class PostBeforeValidate  extends Behavior
{
    /**
     * @inheritdoc
     */
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'getCity'
        ];
    }

    /**
     * Присваимваем город посту
     */
    public function getCity()
    {
        $user = User::find()->select("id")->where(["=", "id", \Yii::$app->user->getId()])->one();

        $this->owner->city = $user->city;
    }


}