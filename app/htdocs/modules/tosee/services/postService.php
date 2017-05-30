<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 26.05.2017
 * Time: 23:39
 */

namespace modules\tosee\services;

use modules\tosee\controllers\frontend\SiteController;
use modules\tosee\models\common\Post as Model;

/**
 * Сервис постов. Вся основная логика выборки постов
 * осталась в контроллере. Тут только логика связей таблиц
 * и логика когда и что и как надо считать. Если например надо изменить
 * логику выборки постов, наприме искать только активные, то все это происходит тут.
 *
 * Class Post
 * @package modules\tosee\service
 */
class postService extends Model
{
    /**
     *  Тут храним запрос
     *
     * @var ActiveQuery
     */
    public $query;

    /**
     * Сколько постов дала последняя выборка
     *
     * @var int
     */
    public $count;

    /**
     * @var array ActiveRecord
     */
    public $result;

    /**
     * @var int Страница
     */
    public $page = 1;

    /**
     * Констукртор. Собираем все что нужно для вывода поста
     *
     * postService constructor.
     * @param array $config
     * @return postService
     */
    public function __construct($config = [])
    {
        parent::__construct($config);

        $this->query = Model::find()
            ->with(["postData", "image"]);

        return $this;
    }

    /**
     * В случае если метод есть в Query (where limit etc)
     * выполняем. Если метода нет исполняем родительский магический метод
     *
     * @param string $name функция
     * @param array $params параметры
     * @return mixed
     */
    public function __call($name, $params)
    {
        if (method_exists($this->query, $name)) {
            call_user_func_array([$this->query, $name], $params); // вызов функции ActiveQuery
            return $this;
        }

        return parent::__call($name, $params);
    }

    /**
     * @return postService
     */
    public static function find()
    {
        return new self;
    }


    /**
     * Считаем сколько постов, добавляем лимиты
     * Получем в переменнуд result результат из массива ActiveRecords
     *
     * @return $this
     */
    public function getAll()
    {
        //всего постов
        $countQuery = clone $this->query;
        $this->count = $countQuery->count();

        //оступ
        $offset = SiteController::$_limit_per_page * ($this->page - 1);

        $this->result = $this->query
            ->limit(SiteController::$_limit_per_page)
            ->offset($offset)
            ->all();

        $this->page = 1;

        return $this;

    }

    public function page($page)
    {
        $this->page = $page;

        return $this;
    }


    /**
     * Считаем сколько всего естьпостов
     * возвращаем ожин эелемент ActiveRecord
     *
     * @return $this
     */
    public function getOne()
    {
        //всего постов
        $this->count = Model::find()->count();

        $this->result = $this->query->one();
        return $this;
    }

    /**
     * Джоинм таблицу дат так как поиск идет только по ней
     *
     * @return $this
     */
    public function search($params)
    {
        array_unshift($params, "or");

        $this->query
            ->leftJoin('{{%post_data}}', '{{%post_data}}.`post_id` = {{%post}}.`id`')
            ->andFilterWhere($params);

        return $this;
    }


}