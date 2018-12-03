<?php

namespace app\modules\users\dto;

use app\abstractions\ServiceConfig;
use dektrium\user\events\FormEvent;

/**
 * Class UserServiceConfig
 * @property \yii\base\Model $user_form_model
 * @method void EVENT_AFTER_REGISTER(object $event)
 * @method void EVENT_BEFORE_REGISTER(object $event)
 * @method void performAjaxValidation(\yii\base\Model $model)
 * @method FormEvent getFormEvent(\yii\base\Model $form)
 * @property object $event
 * @property mixed $action
 * @package app\modules\users\dto
 */
class UserServiceConfig extends ServiceConfig
{
    const ACTION_REGISTRATION = 1;
}