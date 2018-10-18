<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 02.06.17
 * Time: 20:08
 */

namespace app\beheviors;
use yii\base\Behavior;
use app\models\User;
use yii\db\ActiveRecord;


/**
 * Забираем город у текщего юзера
 *
 * Class PostBeforeValidate
 * @package app\beheviors
 */
class PostBeforeValidate  extends Behavior
{
    /**
     * @inheritdoc
     */
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'getCity'
        ];
    }

    /**
     * Присваимваем город посту
     */
    public function getCity()
    {
        $user = User::find()->select("id,city_id")->where(["=", "id", \Yii::$app->user->getId()])->one();
        $this->owner->city_id = $user->city_id;
        $this->owner->user_id = $user->id;
    }


}