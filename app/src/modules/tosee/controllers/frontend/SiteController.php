<?php

namespace app\modules\tosee\controllers\frontend;

use app\dto\TransportModel;
use app\modules\tosee\dto\PostServiceConfig;
use Yii;
use yii\web\Controller;
use app\modules\tosee\services\PostService;
use yii\web\Cookie;
use yii\web\HttpException;

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

    private function getTransportModel($config = [])
    {
        return YII::$app->postService->action(
            new PostServiceConfig($config)
        );
    }

    /**
     * Экшен вывода постов по условиям
     *
     * @param int $page
     * @return string
     */
    public function actionIndex($page = 1)
    {
        return $this->render('index', [
            "postModel" => $this->getTransportModel(['action' => PostServiceConfig::ACTION_FUTURE])
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
        return $this->render('index', [
            "postModel" => $this->getTransportModel(['action' => PostServiceConfig::ACTION_PAST])
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
        return $this->render('index', [
            "postModel" => $this->getTransportModel(['action' => PostServiceConfig::ACTION_BY_DATE, 'date' => $date])
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
        return $this->render('post', [
            "postModel" => $this->getTransportModel(['action' => PostServiceConfig::ACTION_SINGLE_POST, 'id' => (int)$id])
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
        return $this->render('index', [
            "postModel" => $this->getTransportModel([
                'action' => PostServiceConfig::ACTION_SEARCH,
                'keyword' => Yii::$app->request->get('keyword')
            ])
        ]);
    }


    public function actionSetCity()
    {
        if (!Yii::$app->request->isAjax) {
            throw new HttpException(403, "this action can be access by ajax only");
        }

        $id = (int)Yii::$app->request->post('id');

        Yii::$app->response->cookies->add(new  Cookie([
            'name' => 'city_id',
            'value' => $id
        ]));

        return '';
    }

}
