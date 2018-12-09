<?php

namespace app\modules\tosee\controllers;

use app\models\Image;
use app\modules\tosee\dto\PostServiceConfig;
use app\modules\tosee\models\Post;
use app\modules\tosee\models\PostSearch;
use app\modules\tosee\services\PostService;
use app\traits\AjaxValidationTrait;
use ImageAjaxUpload\UploadDTO;
use ImageAjaxUpload\UploadModel;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


/**
 * PostController implements the CRUD actions for Post model.
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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
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
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('my-posts', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Post model.
     *
     * @return string
     * @throws \yii\base\ExitException
     */
    public function actionCreate()
    {
        $post = new Post();
        $this->savePost($post);

        return $this->render('add-post', [
            'post' => $post,
        ]);
    }

    /**
     * Creates a new Post model.
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

   private function savePost(Post $post)
   {
       $this->performAjaxValidation($post);
       $this->performAjaxValidation($post->postDataNN);

       if ($post->load(Yii::$app->request->post()) && $post->validate() && $post->save()) {
           return \Yii::$app->postService->action(
               new PostServiceConfig(['action' => PostService::ACTION_SAVE_POST, 'post' => $post])
           );
       }
   }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
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
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}