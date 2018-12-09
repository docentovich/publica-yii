<?php

namespace app\modules\tosee\controllers;

use app\modules\tosee\dto\ImagesServiceConfig;
use app\modules\tosee\dto\PostServiceConfig;
use app\modules\tosee\services\ImagesService;
use app\modules\tosee\services\PostService;
use Yii;
use yii\web\Controller;
use yii\web\Cookie;
use yii\web\HttpException;

/**
 * Default controller for the `tosee` module
 */
class FrontController extends Controller
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

    private function getPostTransportModel($config = []): \app\modules\tosee\dto\PostTransportModel
    {
        return \Yii::$app->postService->action(
            new PostServiceConfig($config)
        );
    }

    public function actionGenPwd()
    {
        if (YII_ENV_DEV) {
            return \Yii::$app->getSecurity()->generatePasswordHash(
                \Yii::$app->request->get('pwd')
            );
        }
        return '';
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
            "postModel" => $this->getPostTransportModel(['action' => PostService::ACTION_FUTURE])
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
            "postModel" => $this->getPostTransportModel(['action' => PostService::ACTION_PAST])
        ]);
    }

    /**
     * Фильтр по диапазону дат (пока просто дата)
     *
     * @param $date
     * @param int $page
     * @return string
     */
    public function actionDate($date)
    {
        return $this->render('index', [
            "postModel" => $this->getPostTransportModel([
                'action' => PostService::ACTION_BY_DATE,
                'date' => new \DateTime($date)
            ])
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
            "postModel" => $this->getPostTransportModel(['action' => PostService::ACTION_SINGLE_POST, 'id' => (int)$id])
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
            "postModel" => $this->getPostTransportModel([
                'action' => PostService::ACTION_SEARCH,
                'keyword' => Yii::$app->request->get('keyword')
            ])
        ]);
    }


    public function actionLike($image_id)
    {
        if (!Yii::$app->request->isAjax) {
            throw new \Exception('request mast be ajax');
        }

        Yii::$app->imageService->action(
            new ImagesServiceConfig([
                'action' => ImagesService::ACTION_LIKE,
                'user_id' => \Yii::$app->user->getId()
            ])
        );

        Yii::$app->end(200);
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
