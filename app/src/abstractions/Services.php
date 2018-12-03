<?php
namespace app\abstractions;

abstract class Services extends \yii\base\Component
{
    abstract public function action(\app\interfaces\config $config): \app\dto\TransportModel;
}