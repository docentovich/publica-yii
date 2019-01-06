<?php

namespace app\services;


/**
 * Сервис постов. Вся основная логика выборки постов
 * осталась в контроллере. Тут только логика связей таблиц
 * и логика когда и что и как надо считать. Если например надо изменить
 * логику выборки постов, наприме искать только активные, то все это происходит тут.
 *
 * Class Post
 * @package app\service
 */
class BasePostService extends \app\abstractions\Services
{

    /**
     * @param \app\interfaces\config $config
     * @return \app\dto\TransportModel
     * @throws \yii\base\ExitException
     */
    public function action(\app\interfaces\config $config): \app\dto\TransportModel
    {
    }
}