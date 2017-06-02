<?php
namespace modules\tosee\controllers\frontend;

use Yii;
use yii\web\Controller;
use modules\tosee\services\frontend\postService as Post;

/**
 * Default controller for the `tosee` module
 */
class SiteController extends Controller
{


    /**
     * Задаем лайоут
     *
     * @var string
     */
    public $layout = "tosee";

   
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

        $service = (new Post())->page($page)->getFuture();

        return $this->render('index', [
            "service"  => $service,
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

        $service = (new Post())->page($page)->getFuture();

        return $this->render('index', [
            "service"  => $service,
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

        $service = (new Post)->page($page)->getByDate($date);

        return $this->render('index', [
            "service" => $service,
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

        $service = (new Post)->getById($id);

        //передаем в лайоут прошлое
        Yii::$app->view->params['navigation_label'] = $post->result->postData->title;
        Yii::$app->view->params['next_url'] = "/post/" . $post->next;
        Yii::$app->view->params['prev_url'] = "/post/" . $post->prev;

        return $this->render('post', [
            'service' => $service
        ]);
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

        $service = (new Post)->page($page)->search($keyword);

        //передаем в лайоут ключевое слово
        Yii::$app->view->params['navigation_label'] = $keyword;

        return $this->render('index', [
            "service" => $service
        ]);

    }




}
