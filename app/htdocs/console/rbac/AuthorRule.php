<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 03.06.2017
 * Time: 2:53
 */

namespace console\rbac;

use yii\rbac\Rule;

class AuthorRule extends Rule
{
    public $name = "isAuthor";

    public function execute($user, $item, $params)
    {
        return isset($params['post']) ? $params['post']->user_id === $user : false;
    }
}