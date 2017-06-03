<?php

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
     * Много записей
     *
     * @param array $condition
     */
    abstract protected function getMany($condition=[]);

    /**
     * Одна запись
     *
     * @param int $id
     */
    abstract protected function getOne($id);

    /**
     * Поиск
     *
     * @param string $keyword
     * @return array ActiveRecord
     */
    abstract public function search($keyword);

    /**
     * Сохранение
     */
    abstract public function save();
}