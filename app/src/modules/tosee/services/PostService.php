<?php

namespace app\modules\tosee\services;

use app\dto\ConfigQuery;
use app\modules\tosee\dto\PostServiceConfig;
use app\modules\tosee\models\Post;
use League\Pipeline\Pipeline;
use yii\web\Cookie;
use Yii;
use yii\web\HttpException;

/**
 * Сервис постов. Вся основная логика выборки постов
 * осталась в контроллере. Тут только логика связей таблиц
 * и логика когда и что и как надо считать. Если например надо изменить
 * логику выборки постов, наприме искать только активные, то все это происходит тут.
 *
 * Class Post
 * @package app\modules\tosee\service
 */
class PostService extends \app\abstractions\Services
{

    /**
     * @var string Текущий город
     */
    public $city_id = '1';

    /**
     * Констукртор. Собираем все что нужно для вывода поста
     * Города в куках
     *
     * postService constructor.
     * @param array $config
     * @return PostService
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function action(PostServiceConfig $config): \app\dto\PostTransportModel
    {
        switch ($config->action) {
            case PostServiceConfig::ACTION_PAST:
            case PostServiceConfig::ACTION_FUTURE:
            case PostServiceConfig::ACTION_BY_DATE:
                return $this->postsByDate($config);
            case PostServiceConfig::ACTION_SEARCH:
                return $this->postsByKeyword($config);
            case PostServiceConfig::ACTION_SINGLE_POST:
                return $this->postsById($config);
        }
    }

    public function prepareQuery(ConfigQuery $configQuery): ConfigQuery
    {
        if (Yii::$app->request->cookies->has("city_id")) {
            $this->city_id = Yii::$app->request->cookies->getValue("city_id");
        } else {
            Yii::$app->response->cookies->add(new Cookie([
                'name' => 'city_id',
                'value' => $this->city_id
            ]));
        }

        $configQuery->query->with(["postData", "image"])
                ->andWhere(["=", "status", Post::STATUS_ACTIVE])
                ->andWhere(["=", "city_id", $this->city_id]);
        return $configQuery;
    }

    public function prepareQueryByDate(ConfigQuery $configQuery): ConfigQuery
    {
        $compare_method = '';
        switch ($configQuery->config->action) {
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

        $configQuery->query->andWhere("event_at {$compare_method} {$configQuery->config->date->format('Y-m-d')}");
        return $configQuery;
    }

    public function prepareQueryById(ConfigQuery $configQuery): ConfigQuery
    {
        $configQuery->query->andWhere(['id' => $configQuery->config->id]);
        return $configQuery;
    }

    public function postsByDate(PostServiceConfig $config): \app\dto\PostTransportModel
    {
        /** @var ConfigQuery $configQuery */
        $configQuery = (new Pipeline())
            ->pipe([$this, 'prepareQuery'])
            ->pipe([$this, 'prepareQueryByDate'])
            ->process(new ConfigQuery($config, Post::find()));

        return new \app\dto\PostTransportModel($configQuery, $configQuery->query->all());
    }

    public function postsById(PostServiceConfig $config): \app\dto\PostTransportModel
    {
        /** @var ConfigQuery $configQuery */
        $configQuery = (new Pipeline())
            ->pipe([$this, 'prepareQuery'])
            ->pipe([$this, 'prepareQueryById'])
            ->process(new ConfigQuery($config, Post::find()));

        return new \app\dto\PostTransportModel($configQuery, $configQuery->query->one());
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
    public function search($keyword): \app\dto\PostTransportModel
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