<?php

namespace app\modules\tosee\controllers;

use app\models\City;
use app\models\Comments;
use app\modules\tosee\dto\ImagesServiceConfig;
use app\modules\tosee\dto\ImagesTransportModel;
use app\modules\tosee\dto\PostServiceConfig;
use app\modules\tosee\models\Post;
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
        $postModel = $this->getPostTransportModel(['action' => PostService::ACTION_SINGLE_POST, 'id' => (int)$id]);
        if($postModel->result === null){
            throw new \yii\web\NotFoundHttpException('Post not found');
        }
        return $this->render('post', [
            "postModel" => $postModel
        ]);
    }


    /**
     * @return array
     * @throws \Exception
     */
    public function actionSearch()
    {
        if (!Yii::$app->request->isAjax) {
            throw new \Exception('request mast be ajax');
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $transportModel = $this->getPostTransportModel([
            'action' => PostService::ACTION_SEARCH,
            'keyword' => Yii::$app->request->get('keyword')
        ]);

        return [
            'action' => 'search',
            'result' => array_map(function(Post $post) {
                return $post->toArray();
            }, $transportModel->result)
        ];
    }


    public function actionLike()
    {
        if (!Yii::$app->request->isAjax) {
            throw new \Exception('request mast be ajax');
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $data = Yii::$app->request->post();

        /** @var ImagesTransportModel $transporModel */
        $transporModel = Yii::$app->imagesService->action(
            new ImagesServiceConfig([
                'action' => ImagesService::ACTION_LIKE,
                'user_id' => \Yii::$app->user->getId(),
                'id' => $data['image_id']
            ])
        );


        return [
            'action' => $transporModel->result['action'],
        ];
    }

    public function actionComment()
    {
        if (!Yii::$app->request->isAjax) {
            throw new \Exception('request mast be ajax');
        }
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $comment = new Comments();
        $comment->load(Yii::$app->request->post());

        /** @var ImagesTransportModel $transportModel */
        $transportModel = Yii::$app->imagesService->action(
            new ImagesServiceConfig([
                'action' => ImagesService::ACTION_COMMENT,
                'comment' => $comment
            ])
        );

        return $transportModel->result;
    }


    public function actionSetCity($id)
    {
        if(City::findOne(["id" => $id]) === null){
            throw new \Exception('incorrect city', 404);
        }
        Yii::$app->response->cookies->add(new  Cookie([
            'name' => 'city_id',
            'value' => $id
        ]));

        \Yii::$app->response->redirect(['/']);
        \Yii::$app->end();
    }

}
