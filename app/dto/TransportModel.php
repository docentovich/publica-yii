<?php

class TransportModel
{
    /**
     * @var DTO
     */
    private $config;
    /**
     * @var \yii\db\Query
     */
    private $query;

    /**
     * @var \yii\db\ActiveRecord|array
     */
    private $result;

    public function __construct(\config $config, \yii\db\Query $query, $result)
    {
        $this->config = $config;
        $this->query = $query;
        $this->result = $result;
    }

    public function __get($key)
    {
        if (property_exists($this, $key)) {
            return $this->{$key};
        } else {
            return null;
        }
    }
}