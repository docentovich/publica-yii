<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 02.06.17
 * Time: 20:24
 */

namespace modules\tosee\services\backend;
use Yii;


class postServices
{
    /**
     *  Тут храним запрос
     *
     * @var ActiveQuery
     */
    private $_query;

    /**
     * @var string Текущий город
     */
    public $city = 'orl';

    public function __construct()
    {
        $this->city = Yii::$app->user->identity->city;

        $this->_query = Post::find()
            ->with(["postData", "image"])
            ->andWhere("=", "status", Post::STATUS_ACTIVE)
            ->andWhere("=", "city", $this->city);
    }

    private function getMany(){}
    private function getOne(){}
    public function getPosts(){}
    public function search(){}
    public function save(){}
}