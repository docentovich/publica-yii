<?php

namespace app\dto;

use app\dto\ConfigQuery;

/**
 * Class PostTransportModel
 * @property  \app\models\ToseePost|\app\models\ToseePost[] $result
 * @package app\dto
 */
class PostTransportModel extends \app\dto\TransportModel
{
    /** @var null|string */
    public $prevLink;
    /** @var null|string */
    public $nextLink;

    public function __construct(ConfigQuery $configQuery, $result, $prevLink = null, $nextLink = null)
    {
        $this->prevLink = $prevLink;
        $this->nextLink = $nextLink;

        parent::__construct($configQuery, $result);
    }
}