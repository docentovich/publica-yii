<?php

namespace modules\tosee\controllers\frontend;

use Yii;
use yii\web\Controller;
use modules\tosee\models\common\Post;

/**
 * Default controller for the `tosee` module
 */
class SiteController extends Controller
{
    /**
     * Смотрим в будущее
     */
    const FUTURE = "f";

    /**
     * Смотрим в прошлое
     */
    const PAST = "p";

    /**
     * @var string Задаем лайоут
     */
    public $layout = "tosee";

    /**
     * @var int Текущая старница
     */
    public $current_page = 1;

    /**
     * @var int всего итемов
     */
    public $total_items;

    /**
     * @var Будущее или прошло?
     */
    public $future_or_past;

    /**
     * @var int Лимит итемов на страницу
     */
    public $limit_per_page = 20;


    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }


    /**
     * Экшен вывода постов по условиям
     *
     * @param int $page
     * @return string
     */
    public function actionIndex($page = 1)
    {
        $this->current_page  = $page;
        
        //передаем в лайоут будущее
        Yii::$app->view->params['navigation_label'] = "Что будет";
        Yii::$app->view->params['next_url']         = "/past";
        Yii::$app->view->params['prev_url']         = "/past";

        $query = Post::find()
            ->where("event_at >= CURDATE()");

        $posts = $this->getPosts($query);

        return $this->render('index', [
            "posts"             => $posts,
            "url"               => "",
            "total_items"       => $this->total_items,
            "limit_per_page"    => $this->limit_per_page,
            "current_page"      => $this->current_page,
        ]);
    }

    /**
     * Экшен прошлое
     *
     * @param int $page
     * @return string
     */
    public function actionPast($page = 1)
    {
        $this->current_page  = $page;

        //передаем в лайоут прошлое
        Yii::$app->view->params['navigation_label'] = "Что было";
        Yii::$app->view->params['next_url']         = "/";
        Yii::$app->view->params['prev_url']         = "/";

        $query = Post::find()
            ->where("event_at < CURDATE()");


        $posts = $this->getPosts($query);

        return $this->render('index', [
            "posts"             => $posts,
            "url"               => "past",
            "total_items"       => $this->total_items,
            "limit_per_page"    => $this->limit_per_page,
            "current_page"      => $this->current_page,
        ]);

    }

    /**
     * Фильтр по диапазону дат (пока просто дата)
     *
     * @param $date
     * @param int $page
     * @return string
     */
    public function actionDate($date, $page = 1)
    {
        $this->current_page  = $page;

        //передаем в лайоут дату и ссылки
        Yii::$app->view->params['navigation_label'] = $date;
        Yii::$app->view->params['next_url']         = "/" . date('Y-m-d', strtotime('+1 day', strtotime($date)));
        Yii::$app->view->params['prev_url']         = "/" . date('Y-m-d', strtotime('-1 day', strtotime($date)));


        $query = Post::find()
            ->where(["=", "event_at", $date]);


        $posts = $this->getPosts($query);

        return $this->render('index', [
            "posts"             => $posts,
            "url"               => $date, //это для пагинации
            "total_items"       => $this->total_items,
            "limit_per_page"    => $this->limit_per_page,
            "current_page"      => $this->current_page,
        ]);


    }

    /**
     * Экшен поста
     *
     * @param integer $id ид поста
     * @return string
     */
    public function actionPost($id)
    {
        $id = (int) $id;

        $post = Post::find()
            ->where(["=", "id", $id])
            ->with(["postData", "image"])
            ->one();

        $total_posts = Post::find()->count();

        //передаем в лайоут прошлое
        Yii::$app->view->params['navigation_label'] = $post->postData->title;
        Yii::$app->view->params['next_url']         = "/post/" . ((($id + 1) < $total_posts) ? $id + 1 : 1);
        Yii::$app->view->params['prev_url']         = "/post/" . ((($id - 1) > 0) ? $id - 1 : $total_posts);

        return $this->render('post', compact('post'));
    }


    /**
     * Вспомогательный метод. Производит подсчет в $this->total_items
     * и возварщет массив ActiveRecord
     *
     * @param ActiveQuery $query Обьект запроса
     * @return array ActiveRecord.  правильно так писать или нет??
     */
    private function getPosts($query)
    {
        //всего постов
        $countQuery = clone $query;
        $this->total_items = $countQuery->count();

        //получаем посты
        $offset = $this->limit_per_page * ($this->current_page - 1);
        return $query->offset($offset)
            ->limit($this->limit_per_page)
            ->offset($offset)
            ->with(["postData", "image"])
            ->all();
    }

    
}
