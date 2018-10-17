<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 04.06.2017
 * Time: 0:15
 */

namespace app\beheviors;


use yii\base\Behavior;
use Yii;
use yii\db\ActiveRecord;
use yii\web\Cookie;

/**
 * Это добавляет город из кук а если их нет то
 * по IP
 *
 * Class UserBeforInsert
 * @package app\beheviors
 */
class UserBeforValidate extends Behavior
{
    /**
     * @inheritdoc
     */
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'getUsersCity'
        ];
    }

    public function getUsersCity()
    {
        $city_id = "1";

        if ( Yii::$app->request->cookies->has("city_id") )
            $city_id =  Yii::$app->request->cookies->getValue("city_id");
        else
            Yii::$app->response->cookies->add(new  Cookie([
                'name'  => 'city_id',
                'value' => $city_id
            ]));


        $this->owner->city_id = $city_id;
    }


}