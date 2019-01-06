<?php

namespace tosee\dto;

use app\abstractions\ServiceConfig;
use tosee\models\ToseePost;
use tosee\services\ToseePostService;

/**
 * Class PostServiceConfig
 * @property mixed $action;
 * @property string $keyword;
 * @property \DateTime $date;
 * @property int $id;
 * @package tosee\dto
 */
class PostServiceConfig extends ServiceConfig
{
    /** @var ToseePost */
    public $post;
    public $page;
    public $id;
    /** @var PostServiceConfig */
    public $configFromQueryParams;
    /**
     * @var \DateTime|mixed
     */
    public $date;

    public function __construct($config = [])
    {
        $this->date =  new \DateTime($config['date'] ?? 'now');
        $this->page =  $config['page'] ?? 1;
        $this->action =  (int)($config['action'] ?? ToseePostService::ACTION_FUTURE);
        $this->id =  $config['id'] ?? null;
        $this->post = $config['post'] ?? null;
        unset($config['date'],$config['page'],$config['action'],$config['id'],$config['post']);
        parent::__construct($config);
    }

    public function toArray(): array
    {
        return [
            'action' => $this->action,
            'keyword' => $this->keyword,
            'date' => $this->date->format('Y-m-d'),
        ];
    }
}