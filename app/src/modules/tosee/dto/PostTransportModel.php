<?php

namespace app\modules\tosee\dto;

use app\dto\ConfigQuery;

/**
 * Class PostTransportModel
 * @property  \app\modules\tosee\models\Post $result
 * @package app\dto
 */
class PostTransportModel extends \app\dto\TransportModel
{
    /** @var null|string */
    public $prevLink;
    /** @var null|string */
    public $nextLink;
    public $canLike = false;

    public function __construct(ConfigQuery $configQuery, $result, $prevLink = null, $nextLink = null, $canLike)
    {
        $this->prevLink = $prevLink;
        $this->nextLink = $nextLink;
        $this->canLike = $canLike;

        parent::__construct($configQuery, $result);
    }
}