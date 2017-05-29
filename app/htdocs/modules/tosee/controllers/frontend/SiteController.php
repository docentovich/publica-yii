<?php
namespace modules\tosee\controllers\frontend;

use Yii;
use yii\web\Controller;
use modules\tosee\services\postService as Post;

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
     * Задаем лайоут
     *
     * @var string
     */
    public $layout = "tosee";

    /**
     * всего итемов
     *
     * @var int
     */
    public $total_items;

    /**
     * Лимит итемов на страницу
     *
     * @var int
     */
    public static $_limit_per_page = 20;


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

        //передаем в лайоут будущее
        Yii::$app->view->params['navigation_label'] = "Что будет";
        Yii::$app->view->params['next_url'] = "/past";
        Yii::$app->view->params['prev_url'] = "/past";

        $posts = Post::find()
            ->page($page)
            ->where("event_at >= CURDATE()")
            ->getAll();

        return $this->render('index', [
            "posts"         => $posts,
            "url"           => "/%i%",
            "current_page"  => $page
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

        //передаем в лайоут прошлое
        Yii::$app->view->params['navigation_label'] = "Что было";
        Yii::$app->view->params['next_url'] = "/";
        Yii::$app->view->params['prev_url'] = "/";

        $posts = Post::find()
            ->page($page)
            ->where("event_at < CURDATE()")
            ->getAll();

        return $this->render('index', [
            "posts"         => $posts,
            "url"           => "/past/%i%",
            "current_page"  => $page
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

        //передаем в лайоут дату и ссылки
        Yii::$app->view->params['navigation_label'] = $date;
        Yii::$app->view->params['next_url'] = "/" . date('Y-m-d', strtotime('+1 day', strtotime($date)));
        Yii::$app->view->params['prev_url'] = "/" . date('Y-m-d', strtotime('-1 day', strtotime($date)));
        Yii::$app->view->params['current_date'] = $date;

        $posts = Post::find()
            ->page($page)
            ->where(["=", "event_at", $date])
            ->getAll();

        return $this->render('index', [
            "posts"         => $posts,
            "url"           => "$date/%i%", //это для пагинации
            "current_page"  => $page
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
        $id = (int)$id;

        $post = Post::find()
            ->where(["=", "id", $id])
            ->getOne();

        //передаем в лайоут прошлое
        Yii::$app->view->params['navigation_label'] = $post->result->postData->title;
        Yii::$app->view->params['next_url'] = "/post/" . ((($id + 1) < $post->count) ? $id + 1 : 1);
        Yii::$app->view->params['prev_url'] = "/post/" . ((($id - 1) > 0) ? $id - 1 : $post->count);

        return $this->render('post', compact('post'));
    }


    /**
     * Экшен поиска
     *
     * @return string
     * @param int $page
     */
    public function actionSearch($page = 1)
    {
        $keyword = Yii::$app->request->get('keyword');

        $posts = Post::find()
            ->page($page)
            ->search(
                [
                    ["like", "title", $keyword],
                    ["like", "sub_header", $keyword],
                    ["like", "post_short_desc", $keyword],
                    ["like", "post_desc", $keyword],
                ]
            )
            ->getAll();

        //передаем в лайоут ключевое слово
        Yii::$app->view->params['navigation_label'] = $keyword;

        return $this->render('index', [
            "posts" => $posts,
            "url"   => "/serch/%i%?keyword=$keyword", //это для пагинации
            "current_page"  => $page
        ]);

    }




}
