<?php

namespace app\abstractions;

/**
 * Class ServiceConfig
 * @param mixed $action;
 * @package app\abstractions
 */
abstract class ServiceConfig extends Immutable implements \app\interfaces\config
{
    private function _toArray(array $array)
    {
        return array_map(function ($item, $key) {
            if(is_object($item) && method_exists($item, 'toArray')){
                return $item->toArray;
            }
            if(is_array($item)){
                return self::_toArray($item);
            }

            return [$key => $item];
        }, $array, array_keys($array));
    }

    public function toArray(): array
    {
        return self::_toArray($this->_params);
    }
}