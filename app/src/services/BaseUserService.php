<?php

namespace app\services;

use app\abstractions\Services;


class BaseUserService extends Services
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