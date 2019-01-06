<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 26.05.2017
 * Time: 23:39
 */

namespace probank\services\frontend;

use probank\models\Post;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use yii\web\Cookie;
use yii\web\ForbiddenHttpException;
use app\Services;
use Yii;
use yii\web\HttpException;

/**
 * Сервис постов. Вся основная логика выборки постов
 * осталась в контроллере. Тут только логика связей таблиц
 * и логика когда и что и как надо считать. Если например надо изменить
 * логику выборки постов, наприме искать только активные, то все это происходит тут.
 *
 * Class Post
 * @package probank\service
 */
class postService extends Services
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
     * Констукртор. Собираем все что нужно для вывода поста
     * Города в куках
     *
     * postService constructor.
     * @param array $config
     * @return postService
     */
    public function __construct($config = [])
    {

        if ( Yii::$app->request->cookies->has("city_id") )
            $this->city_id =  Yii::$app->request->cookies->getValue("city_id");
        else
            Yii::$app->response->cookies->add(new  Cookie([
                'name'  => 'city_id',
                'value' => $this->city_id
            ]));

        $this->_query = Post::find()
            ->with(["postData", "image"])
            ->andWhere(["=", "status", Post::STATUS_ACTIVE])
            ->andWhere(["=", "city_id", $this->city_id]);
    }

    /**
     * Считаем сколько постов, добавляем лимиты
     * Получем в переменнуд result результат из массива ActiveRecords
     *
     * @return $this
     */
    protected function getMany($condition = [])
    {
        $this->count();

        //оступ
        $offset = $this->limit_per_page * ($this->page - 1);

        //select all
        $this->items = $this->_query
//            ->with(["postData", "image"])
            ->andFilterWhere($condition)
            ->limit($this->limit_per_page)
            ->offset($offset)
            ->all();

    }

    /**
     * Считаем сколько постов, добавляем лимиты
     * Получем в переменнуд result результат из массива ActiveRecords
     *
     * @param int $id
     * @return $this
     */
    protected function getOne($id)
    {

        $clone = clone $this->_query;
        //next
        $this->next = $clone
            ->select("id")
            ->andWhere([">", "id", $id])
            ->one();

        if (empty($this->next)) {
            $clone = clone $this->_query;
            $this->next = $clone
                ->select("id")
                ->limit(1)
                ->orderBy('id ASC')
                ->one();
        }

        $clone = clone $this->_query;
        //prev
        $this->prev = $clone
            ->select("id")
            ->andWhere(["<", "id", $id])
            ->one();

        if (empty($this->prev)) {
            $clone = clone $this->_query;
            $this->prev = $clone
                ->select("id")
                ->limit(1)
                ->orderBy('id DESC')
                ->one();
        }

        //selectOne
        $this->items = $this
            ->_query
            ->andWhere(["=", "id", $id])
            ->one();

    }

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
            ->leftJoin(PostData::tableName(), PostData::tableName() . '.`post_id` = {{%specialist}}.`id`');

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
    public function getFuture()
    {
        $this->_query->andWhere("event_at >= CURDATE()");
        $this->getMany();
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
        $this->_query->andWhere("event_at <= CURDATE()");
        $this->getMany();
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
        $this->getMany(["=", "event_at", $date]);
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
        $this->_query = Post::find()
            ->with(["postData", "image"])
            ->andWhere(["=", "status", Post::STATUS_ACTIVE]);
        //всего постов
        $this->getOne($id);
        return $this;
    }


}