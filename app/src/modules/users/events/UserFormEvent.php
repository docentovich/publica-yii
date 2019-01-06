<?php

namespace users\events;

use yii\base\Event;

class UserFormEvent extends Event
{
    /** @var \app\models\UserForm */
    public $userForm;
}