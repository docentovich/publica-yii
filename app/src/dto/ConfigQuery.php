<?php

namespace app\dto;
use app\interfaces\config;
use yii\db\ActiveQuery;


/**
 * Class ConfigQuery
 * @property \app\interfaces\config $config
 * @property ActiveQuery $query
 * @package app\dto
 */
class ConfigQuery implements  \app\interfaces\dto
{
    /** @var ActiveQuery */
    private $_query;
    /** @var config */
    private $_config;

    public function __set($name, $value)
    {
        if(($name === 'config') && !($value instanceof config)){
            throw new \Exception('config mast implements ' . config::class);
        }
        if(($name === 'query') && !($value instanceof ActiveQuery)){
            throw new \Exception('config mast implements ' . ActiveQuery::class);
        }

        $name = '_' . $name;
        $this->{$name} = $value;
    }

    public function __get($name)
    {
        $name = '_' . $name;
        return $this->{$name};
    }

    public function __construct($config, $query = null)
    {
        $this->config = $config;
        $this->query = $query;
    }
}