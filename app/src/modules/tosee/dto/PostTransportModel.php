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

    public function __construct(ConfigQuery $configQuery, $result, $prevLink = null, $nextLink = null)
    {
        $this->prevLink = $prevLink;
        $this->nextLink = $nextLink;

        parent::__construct($configQuery, $result);
    }
}