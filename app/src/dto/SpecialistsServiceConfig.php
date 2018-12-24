<?php

namespace app\dto;

use app\abstractions\ServiceConfig;
use app\models\Portfolio;

/**
 * Class SpecialistsServiceConfig
 * @package app\dto
 */
class SpecialistsServiceConfig extends ServiceConfig
{
    public function __set($key, $val)
    {
        if($key === 'type' && (in_array($val, Portfolio::ALLOWED_TYPES)) === FALSE)
        {
            throw new \Exception('Portfolio type mast be one of ' . implode(', ', Portfolio::ALLOWED_TYPES));
        }

        return parent::__set($key, $val);
    }
}