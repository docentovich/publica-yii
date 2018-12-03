<?php

namespace app\modules\tosee\dto;

use app\abstractions\ServiceConfig;

/**
 * Class PostServiceConfig
 * @property mixed $action;
 * @package app\modules\tosee\dto
 */
class PostServiceConfig extends ServiceConfig
{
    const ACTION_FUTURE = 1;
    const ACTION_PAST = 2;
    const ACTION_SEARCH = 3;
    const ACTION_SINGLE_POST = 4;
    const ACTION_DATE_PICKER = 5;
    const ACTION_BY_DATE = 6;

    public $page;
    public $id;
    /**
     * @var \DateTime|mixed
     */
    public $date;

    public function __construct($config = [])
    {
        $this->date =  $config['date'] ?? new \DateTime();
        $this->page =  $config['page'] ?? 1;
        $this->action =  $config['action'] ?? PostServiceConfig::ACTION_FUTURE;
        $this->id =  $config['id'] ?? null;
    }
}