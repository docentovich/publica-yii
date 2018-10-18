<?php

namespace app\modules\tosee\controllers\backend;

use app\models\Image;
use app\models\UploadImage;
use app\modules\tosee\models\common\PostData;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Yii;
use app\modules\tosee\models\common\Post;
use app\modules\tosee\models\common\PostSearch;
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
    public $layout = "@current_template/layouts/main";

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
                        'actions' => ['index', 'view', 'update', 'delete', 'create', 'additional-upload'],
                        'allow' => true,
                        'roles' => ['author'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
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

    /**
     * Загрузка главной картинки поста
     *
     * @throws \Exception Если не ajax запретить доступ
     */
//    public function actionUploadMain()
//    {
//        if (!Yii::$app->request->isAjax) {
//            throw new \Exception("this action can be access by ajax only");
//        }
//
//        $model = new Post();
//
//        if ($model->load(Yii::$app->request->post())) {
//            if ($model->image->save())
//                echo $model->image->json;
//        }
//    }

    /**
     * Загрузка доп изображений
     *
     * @throws \Exception Если не ajax запретить доступ
     */
    public function actionAdditionalUpload()
    {
        if (!Yii::$app->request->isAjax) {
            throw new HttpException(403 , "this action can be access by ajax only");
        }

        $upload_model = new UploadImage;

        if ($upload_model->multiUpload( ["215x215"] )) {
            foreach ($upload_model->multiImages as &$image) {

                $image_model = new Image();
                $image_model->path = $image['path'];
                $image_model->name = $image['new_name'];

                if ($image_model->save()) {

                    $image['json']['id'] = $image_model->id;
                    $json[] = $image['json'];

                }
            }

            echo json_encode($json);

        }

        return '';

    }
}
