<?php

namespace app\modules\users\dto;

use app\abstractions\ServiceConfig;

/**
 * Class UserServiceConfig
 * @property \yii\base\Model $userFormModel
 * @property mixed $action
 * @package app\modules\users\dto
 */
class UserServiceConfig extends ServiceConfig
{
    const ACTION_REGISTRATION = 1;
    const ACTION_CHOOSE_ROLE = 2;
}