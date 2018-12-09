<?php

namespace app\modules\tosee\dto;

use app\abstractions\ServiceConfig;

/**
 * Class ImagesServiceConfig
 * @property integer id
 * @property integer user_id
 * @package app\modules\tosee\dto
 */
class ImagesServiceConfig extends ServiceConfig
{
    /** @var integer */
    public $id;
    /** @var integer */
    public $user_id;
}