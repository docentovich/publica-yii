<?php

namespace app\modules\users\events;

use yii\base\Event;

class UserFormEvent extends Event
{
    /** @var \app\models\UserForm */
    public $userForm;
}