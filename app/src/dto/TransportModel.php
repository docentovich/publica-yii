<?php

namespace app\dto;

/**
 * Transport Model is DTO immutable object, which transports configuration of query
 * builded query and result between service and view
 *
 * Class TransportModel
 * @package app\dto
 */
class TransportModel extends \app\abstractions\ImmutableDTO
{
    /**
     * TransportModel constructor.
     * @param ConfigQuery $configQuery
     * @param $result
     */
    public function __construct(ConfigQuery $configQuery, $result)
    {
        parent::__construct(compact('configQuery', 'result'));
    }
}