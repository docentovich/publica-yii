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
    public $query;

    /**
     * @var \yii\db\ActiveRecord|array
     */
    public $result;

    public function __construct(\DTO $config, \yii\db\Query $query)
    {
        $this->config = $config;
        $this->query = $query;
    }

    public function getConfig()
    {
        return $this->config;
    }



    public function executeOne()
    {
        $this->$this->result = $this->query->all()[0];
        return $this;
    }


    public function executeAll()
    {
        $this->$this->result = $this->query->all();
        return $this;
    }
}