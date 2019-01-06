<?php

namespace users\controllers;


use users\models\UsersUser;
use yii\db\ActiveRecord;

class SuperAdminUsersController extends SuperAdminController
{
    protected function getModel(...$params): ActiveRecord
    {
        return new UsersUser();
    }
}