<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 02.06.17
 * Time: 20:24
 */

namespace modules\tosee\services\backend;
use Yii;
use modules\tosee\models\common\Post;

class postServices extends \Services
{
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

    protected function getMany($condition = [])
    {
        // TODO: Implement getMany() method.
    }

    protected function getOne($id)
    {
        // TODO: Implement getOne() method.
    }

    public function search($keyword)
    {
        // TODO: Implement search() method.
    }

    public function save()
    {
        // TODO: Implement save() method.
    }



    public function getPosts()
    {

    }
}