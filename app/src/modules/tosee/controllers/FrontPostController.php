<?php

namespace app\modules\tosee\controllers;

use app\models\Comments;
use app\dto\ImagesServiceConfig;
use app\dto\ImagesTransportModel;
use app\dto\PostServiceConfig;
use app\modules\tosee\models\ToseePost;
use app\modules\tosee\services\ImagesService;
use app\modules\tosee\services\ToseeImagesService;
use app\modules\tosee\services\ToseePostService;
use app\services\BaseImagesService;
use app\services\BasePostService;
use app\traits\AjaxValidationTrait;
use yii\base\Module;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UrlManager;

/**
 * Default controller for the `tosee` module
 */
class FrontPostController extends Controller
{
    use AjaxValidationTrait;
    /** @var BasePostService */
    public $postService;
    /** @var ImagesService */
    public $imagesService;
    /**
     * Задаем лайоут
     *
     * @var string
     */
    public $layout = "@current_template/layouts/main";

    public function __construct(string $id,
                                Module $module,
                                array $config = [],
                                BasePostService $postService,
                                BaseImagesService $imagesService)
    {
        $this->postService = $postService;
        $this->imagesService = $imagesService;
        parent::__construct($id, $module, $config);
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
     * @return \app\dto\PostTransportModel
     * @throws \Throwable
     * @throws \yii\base\ExitException
     */
    private function getPostTransportModel($config = []): \app\dto\PostTransportModel
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
                'date' => new \DateTime($date)
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

        /** @var ImagesTransportModel $transporModel */
        $transportModel = $this->imageService->action(
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
