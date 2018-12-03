<?php

namespace app\modules\users\dto;

use app\abstractions\ServiceConfig;
use dektrium\user\events\FormEvent;

/**
 * Class UserServiceConfig
 * @property \yii\base\Model $user_form_model
 * @method void EVENT_AFTER_REGISTER(object $event) decktrium event
 * @method void EVENT_BEFORE_REGISTER(object $event) decktrium event
 * @method void performAjaxValidation(\yii\base\Model $model) decktrium event ajax validation
 * @method FormEvent getFormEvent(\yii\base\Model $form) send through this closure running
 * decktrium getFormEvent method. it's need when we must to get decktrium controllers events from service
 * @property object $event
 * @property mixed $action
 * @property array $events array of EVENT_NAME => closure()
 * @package app\modules\users\dto
 */
class UserServiceConfig extends ServiceConfig
{
    const ACTION_REGISTRATION = 1;
    const ACTION_CHOOSE_ROLE = 2;
}