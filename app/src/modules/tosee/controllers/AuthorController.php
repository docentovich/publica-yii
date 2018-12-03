<?php

namespace app\modules\tosee\controllers;

use app\models\Image;
use app\models\UploadImage;
use app\modules\tosee\models\PostSearch;
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
                        'actions' => ['my-articles', 'index', 'view', 'update', 'delete', 'create', 'additional-upload'],
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
    public function actionView($id)
    {
        $model = $this->findModel($id);

        if (!Yii::$app->user->can("updatePost", ["post" => $model]))
            throw new HttpException(403 ,"You can't edit post");

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        //TODO REFACTOR!
        $model = new Post();
        $post_data = new PostData();
        $upload = new UploadImage();

        $post = Yii::$app->request->post();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($post_data->load(Yii::$app->request->post())) {

                $upload->upload(["350x390"]);

                if ($model->save()) {

                    $mainImage = new Image(["path" => $upload->path, "name" => $upload->new_name]);
                    $mainImage->save();

                    $model->link("postData", $post_data);
                    $model->link("image", $mainImage);

                    if (isset($post['PostToImage']))
                        foreach ($post['PostToImage']['image_id'] as $image_id) {
                            $image_id = (int)$image_id;
                            $addidtional = Image::findOne(["=", "id", $image_id]);
                            $model->link("images", $addidtional);
                        }

                    return $this->redirect(['view', 'id' => $model->id]);
                }

            }
        }


        return $this->render('create', [
            'model' => $model,
            'post_data' => $post_data,
            'upload' => $upload,

        ]);

    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        //TODO REFACTOR!

        $model = $this->findModel($id);

        if (!Yii::$app->user->can("updatePost", ["post" => $model]))
            throw new HttpException(403 ,"You can't edit post");


        $upload = new UploadImage();
        $post_data = $model->postData;


        $post = Yii::$app->request->post();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($post_data->load(Yii::$app->request->post())) {

                if ($upload->upload(["350x390"])) {
                    $model->image->path = $upload->path;
                    $model->image->name = $upload->new_name;
                    $model->image->save();
                }

                if ($model->save()) {
                    $post_data->save();

                    if (isset($post['PostToImage']))
                        foreach ($post['PostToImage']['image_id'] as $image_id) {
                            $image_id = (int)$image_id;
                            $addidtional = Image::findOne(["=", "id", $image_id]);
                            $model->link("images", $addidtional);
                        }

                    return $this->redirect(['view', 'id' => $model->id]);
                }

            }
        }


        return $this->render('update', [
            'model' => $model,
            'post_data' => $model->postData,
            'upload' => $upload,
        ]);

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
            throw new HttpException(403 ,"You can't edit post");

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
