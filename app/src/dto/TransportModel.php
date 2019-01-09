<?php

namespace app\dto;

use yii\helpers\ArrayHelper;

/**
 * Transport Model is DTO immutable object, which transports configuration of query
 * builded query and result between service and view
 *
 * Class TransportModel
 * @property ConfigQuery $configQuery
 * @property \app\interfaces\config $config
 * @property mixed $result
 * @package app\dto
 */
class TransportModel extends \app\abstractions\Immutable
{
    /**
     * TransportModel constructor.
     * @param ConfigQuery $configQuery
     * @param mixed $result
     */
    public function __construct(ConfigQuery $configQuery, $result = [])
    {
        parent::__construct(compact('configQuery', 'result'));
    }

    public function __get($key)
    {
        if(($key==='config') && ArrayHelper::getValue($this->_params, 'configQuery.config')){
            return $this->_params['configQuery']->config;
        }
        return parent::__get($key);
    }

    public static function build($options)
    {
        return new static($options['configQuery'], $options['result']);
    }
}