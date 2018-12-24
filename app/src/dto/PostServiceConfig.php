<?php

namespace app\dto;

use app\abstractions\ServiceConfig;
use app\models\Post;
use app\services\BasePostService;

/**
 * Class PostServiceConfig
 * @property mixed $action;
 * @property string $keyword;
 * @package app\dto
 */
class PostServiceConfig extends ServiceConfig
{
    /** @var Post */
    public $post;
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
        $this->action =  $config['action'] ?? BasePostService::ACTION_FUTURE;
        $this->id =  $config['id'] ?? null;
        $this->post = $config['post'] ?? null;
        unset($config['date'],$config['page'],$config['action'],$config['id'],$config['post']);
        parent::__construct($config);
    }
}