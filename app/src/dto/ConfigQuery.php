<?php

namespace app\dto;

/**
 * Class ConfigQuery
 * @package app\dto
 */
class ConfigQuery implements  \app\interfaces\dto
{
    /** @var \yii\db\Query */
    public $query;
    /** @var \app\interfaces\config */
    public $config;

    public function __construct($config, $query = null)
    {
        $this->config = $config;
        $this->query = $query;
    }
}