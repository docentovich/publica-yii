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
     * @param \app\interfaces\config $config
     * @param \yii\db\Query $query
     * @param \yii\db\ActiveRecord|mixed $result
     */
    public function __construct(
        \app\interfaces\config $config,
        \yii\db\Query $query,
        $result)
    {
        parent::__construct(compact('config', 'query', 'result'));
    }
}