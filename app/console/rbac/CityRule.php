<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 03.06.2017
 * Time: 2:53
 */

namespace console\rbac;

use yii\rbac\Rule;
use Yii;

class CityRule extends Rule
{
    public $name = "isCityModerator";

    public function execute($user, $item, $params)
    {
        return isset($params['object']) ? $params['object']->city_id === Yii::$app->user->identity->city_id : false;
    }
}