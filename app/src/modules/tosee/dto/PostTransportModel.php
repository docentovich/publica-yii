<?php

namespace tosee\dto;

use app\dto\ConfigQuery;
use app\dto\TransportModel;

/**
 * Class PostTransportModel
 * @property  \app\models\Post|\app\models\Post[] $result
 * @property PostServiceConfig $config;
 * @package tosee\dto
 */
class PostTransportModel extends TransportModel
{
    /** @var null|\app\models\Post */
    public $prevPost;
    /** @var null|\app\models\Post */
    public $nextPost;

    public function __construct(ConfigQuery $configQuery, $result, $prevPost = null, $nextPost = null)
    {
        $this->prevPost = $prevPost;
        $this->nextPost = $nextPost;

        parent::__construct($configQuery, $result);
    }
}