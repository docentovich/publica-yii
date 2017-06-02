<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 26.05.2017
 * Time: 23:39
 */

namespace modules\tosee\services\frontend;

use modules\tosee\controllers\frontend\SiteController;
use modules\tosee\models\common\Post as Model;
use modules\tosee\models\common\Post;
use modules\tosee\PostConstnants;

/**
 * Сервис постов. Вся основная логика выборки постов
 * осталась в контроллере. Тут только логика связей таблиц
 * и логика когда и что и как надо считать. Если например надо изменить
 * логику выборки постов, наприме искать только активные, то все это происходит тут.
 *
 * Class Post
 * @package modules\tosee\service
 */
class postService
{

    /**
     * Лимит итемов на страницу
     *
     * @var int
     */
    public $limit_per_page = 20;

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
     * @var int Страница
     */
    public $page = 1;

    /**
     * @var null/id следующий доступный id
     */
    public $next = NULL;

    /**
     * @var null/id предыдущий доступный id
     */
    public $prev = NULL;

    /**
     * @var string вид урлов для пагинации
     */
    public $url;

    /**
     * Констукртор. Собираем все что нужно для вывода поста
     *
     * postService constructor.
     * @param array $config
     * @return postService
     */
    public function __construct($config = [])
    {
        if (isset(Yii::$app->session['city']))
            $this->city = Yii::$app->session['city'];

        $this->_query = Post::find()
            ->with(["postData", "image"])
            ->andWhere("=", "status", Post::STATUS_ACTIVE)
            ->andWhere("=", "city", $this->city);
    }


    private function count()
    {
        //всего постов
        $countQuery = clone $this->query;
        $this->count = $countQuery->count();
    }


    /**
     * Считаем сколько постов, добавляем лимиты
     * Получем в переменнуд result результат из массива ActiveRecords
     *
     * @return $this
     */
    private function getMany($condition=[])
    {
        $this->count();

        //оступ
        $offset = $this->limit_per_page * ($this->page - 1);

        //select all
        $this->items = $this->_query
            ->andWhere($condition)
            ->limit($this->limit_per_page)
            ->offset($offset)
            ->all();

    }

    /**
     * Считаем сколько постов, добавляем лимиты
     * Получем в переменнуд result результат из массива ActiveRecords
     *
     * @return $this
     */
    private function getOne($id)
    {

        //next
        $this->next = $this
            ->_query
            ->select("id")
            ->andWhere([">", "id", $id])
            ->one();

        if (empty($this->next))
            $next = $this
                ->_query
                ->select("id")
                ->andWhere([">", "min(id)", $id])
                ->one();


        //prev
        $this->prev = $this
            ->_query
            ->select("id")
            ->andWhere(["<", "id", $id])
            ->one();

        if (empty($this->prev))
            $this->prev = $this
                ->_query
                ->select("id")
                ->andWhere(["<", "max(id)", $id])
                ->one();

        //selectOne
        $this->items = $this
            ->_query
            ->andWhere(["=", "id", $id])
            ->one();

    }

    /**
     * Задать текующую страницу
     *
     * @param string $page Страница
     * @return $this postServices
     */
    public function page($page)
    {
        $this->page = $page;
        return $this;
    }


    /**
     * Будующее
     *
     * @return $this
     */
    public function getFuture()
    {
        return $this->_query->getMany("event_at > CURDATE()");
        $this->url = "/%i%";
        return $this;

    }

    /**
     * Прошлое
     *
     * @return $this
     */
    public function getPast()
    {
        return $this->_query->getMany("event_at < CURDATE()");
        $this->url = "/past/%i%";
        return $this;

    }

    /**
     * По дате
     *
     * @param $date
     * @return $this
     */
    public function getByDate($date)
    {
        $this->_query->getMany(["=", "event_at", $date]);
        $this->url = "$date/%i%";
        return $this;
    }

    /**
     * По периоду
     *
     * @param $periodStarts
     * @param $periodEnds
     */
    public function getByPeriod($periodStarts, $periodEnds)
    {

    }

    /**
     * По ид
     *
     * @param $id
     * @return $this
     */
    public function getById($id)
    {
        //всего постов
        $this->getOne($id);
        return $this;
    }

    /**
     * поиск по ключевому слову
     *
     * @return $this
     */
    public function search($keyword)
    {
        $params =
            [
                ["or"],
                ["like", "title", $keyword],
                ["like", "sub_header", $keyword],
                ["like", "post_short_desc", $keyword],
                ["like", "post_desc", $keyword],
            ];

        $this->_query
            ->leftJoin('{{%post_data}}', '{{%post_data}}.`post_id` = {{%post}}.`id`');

        $this->getMany($params);
        $this->url = "/%i%?keyword=$keyword";

        return $this;
    }


}