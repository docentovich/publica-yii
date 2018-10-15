<?php
namespace components;
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 02.06.2017
 * Time: 21:45
 */
abstract class Services
{
    /**
     *  Тут храним запрос
     *
     * @var ActiveQuery
     */
    protected $_query;

    /**
     * Сколько постов дала последняя выборка
     *
     * @var int
     */
    public $count;

    /**
     * @var array ActiveRecord
     */
    public $items;


    /**
     * Подсчет количесва и cохранение в $count
     */
    protected function count()
    {
        //всего результатов
        $countQuery = clone $this->_query;
        $this->count = $countQuery->count();
    }

}