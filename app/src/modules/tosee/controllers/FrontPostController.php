<?php

namespace tosee\controllers;

use app\models\Comments;
use app\dto\ImagesServiceConfig;
use app\dto\ImagesTransportModel;
use tosee\dto\PostServiceConfig;
use tosee\services\ToseeImagesService;
use tosee\services\ToseePostService;
use app\traits\AjaxValidationTrait;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `tosee` module
 */
class FrontPostController extends Controller
{
    use AjaxValidationTrait;
    /** @var ToseePostService */
    protected $postService;
    /** @var \app\services\BaseImagesService */
    protected $imagesService;
    /**
     * Задаем лайоут
     *
     * @var string
     */
    public $layout = "@current_template/layouts/main";

    public function setImagesService($imagesService)
    {
        $this->imagesService = $imagesService;
    }

    public function getImagesService()
    {
        return $this->imagesService;
    }

    public function setPostService($postService)
    {
        $this->postService = $postService;
    }

    public function getPostService()
    {
        return $this->postService;
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['author'],
                    ], [
                        'actions' => ['like', 'comment'],
                        'allow' => true,
                        'roles' => ['@'],
                    ], [
                        'actions' => ['gen-pwd', 'index', 'past', 'date', 'post', 'search'],
                        'allow' => true,
                        'roles' => ['?', '@'],
                    ]
                ],
            ],
        ];
    }

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
     * @param array $config
     * @return \tosee\dto\PostTransportModel
     * @throws \Throwable
     * @throws \yii\base\ExitException
     */
    private function getPostTransportModel($config = []): \tosee\dto\PostTransportModel
    {
        return $this->postService->action(
            new PostServiceConfig($config)
        );
    }

    /**
     * @return string
     * @throws \yii\base\Exception
     */
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
     * @throws \Throwable
     * @throws \yii\base\ExitException
     */
    public function actionIndex($page = 1)
    {
        return $this->render('posts', [
            "postModel" => $this->getPostTransportModel(['action' => ToseePostService::ACTION_FUTURE])
        ]);
    }

    /**
     * Экшен прошлое
     *
     * @param int $page
     * @return string
     * @throws \Throwable
     * @throws \yii\base\ExitException
     */
    public function actionPast($page = 1)
    {
        return $this->render('posts', [
            "postModel" => $this->getPostTransportModel(['action' => ToseePostService::ACTION_PAST])
        ]);
    }

    /**
     * Фильтр по диапазону дат (пока просто дата)
     *
     * @param $date
     * @return string
     * @throws \Throwable
     * @throws \yii\base\ExitException
     */
    public function actionDate($date)
    {
        return $this->render('posts', [
            "postModel" => $this->getPostTransportModel([
                'action' => ToseePostService::ACTION_BY_DATE,
                'date' => $date
            ])
        ]);
    }

    /**
     * @return array
     * @throws \Throwable
     */
    public function actionLike()
    {
        if (!\Yii::$app->request->isAjax) {
            throw new \Exception('request mast be ajax');
        }

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $data = \Yii::$app->request->post();

        /** @var ImagesTransportModel  */
        $transportModel = $this->imagesService->action(
            new ImagesServiceConfig([
                'action' => ToseeImagesService::ACTION_LIKE,
                'user_id' => \Yii::$app->user->getId(),
                'id' => $data['image_id']
            ])
        );


        return [
            'action' => $transportModel->result['action'],
        ];
    }

    /**
     * @return mixed
     * @throws \Throwable
     */
    public function actionComment()
    {
        if (!\Yii::$app->request->isAjax) {
            throw new \Exception('request mast be ajax');
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $comment = new Comments();
        $comment->load(\Yii::$app->request->post());

        /** @var ImagesTransportModel $transportModel */
        $transportModel = $this->imagesService->action(
            new ImagesServiceConfig([
                'action' => ToseeImagesService::ACTION_COMMENT,
                'comment' => $comment
            ])
        );

        return $transportModel->result;
    }

    /**
     * @return array
     * @throws \Throwable
     * @throws \yii\base\ExitException
     */
    public function actionSearch()
    {
        $transportModel = $this->getPostTransportModel([
            'action' => ToseePostService::ACTION_SEARCH,
        ]);
       return $transportModel->result;
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\base\ExitException
     */
    public function actionPost($id)
    {
        $postModel = $this->getPostTransportModel(['action' => ToseePostService::ACTION_SINGLE_POST, 'id' => (int)$id]);
        if($postModel->result === null){
            throw new NotFoundHttpException('Post not found');
        }
        return $this->render('post', [
            "postModel" => $postModel
        ]);
    }

}
