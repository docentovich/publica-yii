<?php

namespace app\modules\tosee\controllers;

use app\models\City;
use app\models\Image;
use app\models\UploadImage;
use app\modules\tosee\models\Post;
use app\modules\tosee\models\PostData;
use app\modules\tosee\models\PostSearch;
use app\traits\AjaxValidationTrait;
use ImageAjaxUpload\UploadDTO;
use ImageAjaxUpload\UploadModel;
use Yii;
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
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('my-posts', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
//    public function actionView($id)
//    {
//        $model = $this->findModel($id);
//
//        if (!Yii::$app->user->can("updatePost", ["post" => $model]))
//            throw new HttpException(403, "You can't edit post");
//
//        return $this->render('view', [
//            'model' => $this->findModel($id),
//        ]);
//    }

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
    public function actionEdit($id)
    {
        $post = $this->findModel($id);
        $this->savePost($post);

        return $this->render('update-post', [
            'post' => $post,
        ]);
    }

    /**
     * Update or create the post
     * If is successful, the browser will be redirected to the 'view' page.
     *
     * @param Post $post
     * @return \yii\web\Response|void
     * @throws \yii\base\ExitException
     */
    public function savePost(Post $post)
    {
        /** TODO to service */
        $this->performAjaxValidation($post);
        $this->performAjaxValidation($post->postDataNN);

        if ($post->load(Yii::$app->request->post()) && $post->validate() && $post->save()) {
            $this->savePostData($post);
            $this->saveMainPhoto($post);
            $this->saveAdditionalPhoto($post);

            $this->redirect(['edit', 'id' => $post->id]);
            \Yii::$app->end();
        }
    }

    private function saveAdditionalPhoto(Post $post)
    {
        // prepare images objects and if there are some images to save
        // set isNeedDelete = true to delete all old related images
        array_map(
            function ($item) use ($post) {
                /** @var UploadDTO $item */
                $image = new Image();
                $image->load($item->toArray(), '');
                if ($image->validate()) {
                    $image->save();
                    $post->link('additionalImages', $image);
                }
            },
            (new UploadModel(['instance' => 1]))->multiUpload(\Yii::$app->user->getId())
        );
    }

    private function savePostData(Post $post)
    {
        if ($post->postDataNN->load(Yii::$app->request->post()) && $post->postDataNN->validate() ) {
            $post->link('postData', $post->postDataNN);
        }
    }

    private function saveMainPhoto(Post $post)
    {
        // main image. get current, replace bay load, save, link
        $main_image = $post->imageNN;
        $main_image->load(
            (new UploadModel())->upload(\Yii::$app->user->getId())->toArray(), ''
        );
        if ($main_image->validate()) {
            $main_image->save();
            $post->link('image', $main_image);
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