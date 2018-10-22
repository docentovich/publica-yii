<?php

namespace app\abstractions;

class ImmutableDTO implements \app\interfaces\dto
{
    private $_params = [];

    public function __construct($params)
    {
        $this->_params = $params;
    }

    public function __get($key)
    {
        if (isset($this->_params[$key])) {
            return $this->_params[$key];
        } else {
            return null;
        }
    }

    public function __set($key, $val)
    {
        return;
    }
}