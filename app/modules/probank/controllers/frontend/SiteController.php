<?php
namespace modules\probank\controllers\frontend;

use Yii;
use yii\web\Controller;
use modules\probank\services\frontend\postService as Post;
use yii\web\Cookie;
use yii\web\HttpException;

/**
 * Default controller for the `probank` module
 */
class SiteController extends Controller
{


    /**
     * Задаем лайоут
     *
     * @var string
     */
    public $layout = "@current_template/layouts/main";


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
        Yii::$app->view->title = "Что будет";
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
        Yii::$app->view->title = "Что было";
        Yii::$app->view->params['navigation_label'] = "Что было";
        Yii::$app->view->params['next_url'] = "/";
        Yii::$app->view->params['prev_url'] = "/";

        $service = (new Post())->page($page)->getPast();

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
        Yii::$app->view->params['navigation_label'] = $service->items->postData->title;
        Yii::$app->view->title = $service->items->postData->title;
        Yii::$app->view->params['next_url'] = (isset($service->next)) ?  "/post/" . $service->next->id : "/" ;
        Yii::$app->view->params['prev_url'] = (isset($service->prev)) ?  "/post/" . $service->prev->id : "/";

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


    public function actionSetCity(){
        if (!Yii::$app->request->isAjax) {
            throw new HttpException(403 , "this action can be access by ajax only");
        }

        $id = (int) Yii::$app->request->post('id');

        Yii::$app->response->cookies->add(new  Cookie([
            'name'  => 'city_id',
            'value' => $id
        ]));

        return '';
    }

}
