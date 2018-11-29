<?php

namespace app\modules\users\controllers;


use app\models\User;
use yii\db\ActiveRecord;

class SuperAdminUsersController extends SuperAdminController
{
    protected function getModel(...$params): ActiveRecord
    {
        return new User();
    }
}