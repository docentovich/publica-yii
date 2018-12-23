<?php

namespace app\modules\tosee\controllers;

use app\modules\tosee\dto\PostServiceConfig;
use app\modules\tosee\models\ToseePost;
use app\modules\tosee\models\ToseePostSearch;
use app\modules\tosee\services\ToseePostService;
use app\traits\AjaxValidationTrait;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;


/**
 * PostController implements the CRUD actions for ToseePost model.
 */
class AuthorController extends Controller
{
    use AjaxValidationTrait;
    public $layout = "@current_template/layouts/user";

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'delete' => ['POST'],
//                ],
//            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['author'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionMyArticles()
    {
        /** @var ActiveDataProvider $dataProvider */
        $searchModel = new ToseePostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('my-posts', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new ToseePost model.
     *
     * @return string
     */
    public function actionCreate()
    {
        $post = new ToseePost();
        $this->savePost($post);

        return $this->render('add-post', [
            'post' => $post,
        ]);
    }

    /**
     * Creates a new ToseePost model.
     *
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     * @throws \yii\base\ExitException
     */
    public function actionUpdate($id)
    {
        $post = $this->findModel($id);
        $this->savePost($post);

        return $this->render('update-post', [
            'post' => $post,
        ]);
    }

    /**
     * @param ToseePost $post
     * @return mixed
     * @throws \yii\base\ExitException
     */
    private function savePost(ToseePost $post)
    {
        $this->performAjaxValidation($post);
        $this->performAjaxValidation($post->postDataNN);

        if ($post->load(Yii::$app->request->post()) && $post->validate() && $post->save()) {
            return \Yii::$app->postService->action(
                new PostServiceConfig(['action' => ToseePostService::ACTION_SAVE_POST, 'post' => $post])
            );
        }
    }

    /**
     * Deletes an existing ToseePost model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param $id
     * @return \yii\web\Response
     * @throws HttpException
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        /** TODO to service */
        $model = $this->findModel($id);

        if (!Yii::$app->user->can("updatePost", ["post" => $model]))
            throw new HttpException(403, "You can't edit post");

        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ToseePost model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ToseePost the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ToseePost::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}