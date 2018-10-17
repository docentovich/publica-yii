<?php

namespace modules\tosee\services;

use modules\tosee\DTO\PostServiceConfig;
use modules\tosee\models\common\Post;
use yii\db\Query;
use yii\db\QueryBuilder;
use yii\web\Cookie;
use components\Services;
use Yii;
use yii\web\HttpException;

/**
 * Сервис постов. Вся основная логика выборки постов
 * осталась в контроллере. Тут только логика связей таблиц
 * и логика когда и что и как надо считать. Если например надо изменить
 * логику выборки постов, наприме искать только активные, то все это происходит тут.
 *
 * Class Post
 * @package modules\tosee\service
 */
class PostService extends Services
{

    /**
     * Лимит итемов на страницу
     *
     * @var int
     */
    public $limit_per_page = 20;


    /**
     * @var string Текущий город
     */
    public $city_id = '1';


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
     * @var Query
     */
    public $prepared_query;
    public $config;

    /**
     * Констукртор. Собираем все что нужно для вывода поста
     * Города в куках
     *
     * postService constructor.
     * @param array $config
     * @return PostService
     */
    public function __construct()
    {}

    private function prepare(PostServiceConfig $config){
        $this->config = $config;

        if (Yii::$app->request->cookies->has("city_id")) {
            $this->city_id = Yii::$app->request->cookies->getValue("city_id");
        } else {
            Yii::$app->response->cookies->add(new Cookie([
                'name' => 'city_id',
                'value' => $this->city_id
            ]));
        }

        $this->prepared_query = Post::find()
            ->with(["postData", "image"])
            ->andWhere(["=", "status", Post::STATUS_ACTIVE])
            ->andWhere(["=", "city_id", $this->city_id]);

        $compare_method = '';
        switch ($config->action) {
            case PostServiceConfig::ACTION_FUTURE:
                $compare_method .= '>=';
                break;
            case PostServiceConfig::ACTION_PAST:
                $compare_method .= '<=';
                break;
            case PostServiceConfig::ACTION_BY_DATE:
                $compare_method .= '=';
                break;
        }

        $this->prepared_query->andWhere("event_at ${$compare_method} {$config->date}");
    }

    public function posts(PostServiceConfig $config)
    {
        $this->prepare($config);

        return new \TransportModel(
            $this->config,
            $this->prepared_query,
            $this->prepared_query->all()
        );
    }

    public function post()
    {
        return $this->transport_model->executeOne();
    }

    /**
     * Считаем сколько постов, добавляем лимиты
     * Получем в переменнуд result результат из массива ActiveRecords
     *
     * @return $this
     */
//    protected function getMany($condition = [])
//    {
//        $this->count();
//
//        //оступ
//        $offset = $this->limit_per_page * ($this->page - 1);
//
//        //select all
//        $this->items = $this->_query
////            ->with(["postData", "image"])
//            ->andFilterWhere($condition)
//            ->limit($this->limit_per_page)
//            ->offset($offset)
//            ->all();
//
//    }

    /**
     * Считаем сколько постов, добавляем лимиты
     * Получем в переменнуд result результат из массива ActiveRecords
     *
     * @param int $id
     * @return $this
     */
//    protected function getOne($id)
//    {
//
//        $clone = clone $this->_query;
//        //next
//        $this->next = $clone
//            ->select("id")
//            ->andWhere([">", "id", $id])
//            ->one();
//
//        if (empty($this->next)) {
//            $clone = clone $this->_query;
//            $this->next = $clone
//                ->select("id")
//                ->limit(1)
//                ->orderBy('id ASC')
//                ->one();
//        }
//
//        $clone = clone $this->_query;
//        //prev
//        $this->prev = $clone
//            ->select("id")
//            ->andWhere(["<", "id", $id])
//            ->one();
//
//        if (empty($this->prev)) {
//            $clone = clone $this->_query;
//            $this->prev = $clone
//                ->select("id")
//                ->limit(1)
//                ->orderBy('id DESC')
//                ->one();
//        }
//
//        //selectOne
//        $this->items = $this
//            ->_query
//            ->andWhere(["=", "id", $id])
//            ->one();
//
//    }

    /**
     * поиск по ключевому слову
     * @param string $keyword
     * @return $this
     */
    public function search($keyword)
    {
        $params =
            [
                "or",
                ["like", "title", $keyword],
                ["like", "sub_header", $keyword],
                ["like", "post_short_desc", $keyword],
                ["like", "post_desc", $keyword]
            ];

        $this->_query
            ->leftJoin(PostData::tableName(), PostData::tableName() . '.`post_id` = {{%post}}.`id`');

        $this->getMany($params);
        $this->url = "/%i%?keyword=$keyword";

        return $this;
    }


    public function save()
    {
        throw new HttpException(403, "Access denied");
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
//    public function getFuture()
//    {
//        $this->_query->andWhere("event_at >= CURDATE()");
//        $this->getMany();
//        $this->url = "/%i%";
//        return $this;
//
//    }

    /**
     * Прошлое
     *
     * @return $this
     */
//    public function getPast()
//    {
//        $this->_query->andWhere("event_at <= CURDATE()");
//        $this->getMany();
//        $this->url = "/past/%i%";
//        return $this;
//
//    }


    /**
     * По дате
     *
     * @param $date
     * @return $this
     */
//    public function getByDate($date)
//    {
//        $this->getMany(["=", "event_at", $date]);
//        $this->url = "$date/%i%";
//        return $this;
//    }

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
//    public function getById($id)
//    {
//        $this->_query = Post::find()
//            ->with(["postData", "image"])
//            ->andWhere(["=", "status", Post::STATUS_ACTIVE]);
//        //всего постов
//        $this->getOne($id);
//        return $this;
//    }


}