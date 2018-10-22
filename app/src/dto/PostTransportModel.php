<?php

namespace app\dto;

/**
 * Class PostTransportModel
 * @property  \app\modules\tosee\models\Post $result
 * @package app\dto
 */
class PostTransportModel extends TransportModel
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