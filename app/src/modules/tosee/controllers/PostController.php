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
use app\traits\AjaxValidationTrait;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Cookie;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\UrlManager;

/**
 * Default controller for the `tosee` module
 */
class PostController extends Controller
{
    use AjaxValidationTrait;

    /**
     * Задаем лайоут
     *
     * @var string
     */
    public $layout = "@current_template/layouts/main";

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
                        'roles' => ['guest'],
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
     * @return \app\modules\tosee\dto\PostTransportModel
     */
    private function getPostTransportModel($config = []): \app\modules\tosee\dto\PostTransportModel
    {
        return \Yii::$app->postService->action(
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
     * @return array
     * @throws \Exception
     */
    public function actionLike()
    {
        if (!Yii::$app->request->isAjax) {
            throw new \Exception('request mast be ajax');
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $data = Yii::$app->request->post();

        /** @var ImagesTransportModel $transporModel */
        $transportModel = Yii::$app->imagesService->action(
            new ImagesServiceConfig([
                'action' => ImagesService::ACTION_LIKE,
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
     * @throws \Exception
     */
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




    /**
     * @return array
     * @throws \Exception
     */
    public function actionSearch()
    {
        if (!\Yii::$app->request->isAjax) {
            throw new \Exception('request mast be ajax');
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $keyword = \Yii::$app->request->get('keyword');
        if(strlen($keyword) < 4)
        {
            return [];
        }

        $transportModel = $this->getPostTransportModel([
            'action' => PostService::ACTION_SEARCH,
            'keyword' => $keyword
        ]);
        /** @var UrlManager $url_manager */
        $url_manager = \Yii::$app->urlManagerFrontEnd;

        return [
            'action' => 'search',
            'result' => array_map(function(Post $post) use ($url_manager) {
                return ArrayHelper::merge(
                    $post->toArray(),
                    [
                        "url" => $url_manager->createAbsoluteUrl(['/project/post/post', "id" => $post->id])
                    ]
                );
            }, $transportModel->result)
        ];
    }

    /**
     * @param $id
     * @return string
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionPost($id)
    {
        $postModel = $this->getPostTransportModel(['action' => PostService::ACTION_SINGLE_POST, 'id' => (int)$id]);
        if($postModel->result === null){
            throw new NotFoundHttpException('Post not found');
        }
        return $this->render('post', [
            "postModel" => $postModel
        ]);
    }



}
