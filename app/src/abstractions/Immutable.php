<?php

namespace app\abstractions;

use yii\helpers\ArrayHelper;

class Immutable implements \app\interfaces\dto
{
    protected $_params = [];

    public function __construct($params)
    {
        $this->_params = ArrayHelper::merge($this->_params, $params ?? []);
    }

    public function __get($key)
    {
        if (isset($this->_params[$key])) {
            return $this->_params[$key];
        } else {
            return null;
        }
    }

    public function __call($name, $arguments)
    {
        if (isset($this->_params[$name])) {
            return $this->_params[$name](...$arguments);
        } else {
            throw new \Exception('method not found');
        }
    }

    public function __set($key, $val)
    {
        if (!isset($this->_params[$key])) {
            $this->_params[$key] = $val;
        } else {
            return;
        }
    }
}