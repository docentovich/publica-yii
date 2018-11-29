<?php

namespace app\modules\tosee\controllers;

use app\modules\tosee\models\common\ModeratorPostSearch;
use app\modules\tosee\models\common\Post;
use app\modules\tosee\models\common\PostSearch;
use yii\BaseYii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ModeratorController extends Controller
{
    public $layout = "@current_template/layouts/main";

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [

            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
//                        'actions' => ['*'],
                        'allow' => true,
                        'roles' => ['moderator'],
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

        $get = Yii::$app->request->queryParams;

        if(isset($get['status']))
        {
            $id = (int)$get['id'];
            $model = $this->findModel($id);

            if(Yii::$app->user->can("moderatePost", ["object" => $model])){
                $model->status = (int) $get['status'];
                $model->save();

                return $this->redirect(['/tosee/moderator/index']);
            }

        }

        $searchModel = new ModeratorPostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionAll()
    {

        $searchModel = new ModeratorPostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, true);

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
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }



    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id* @return Post the loaded model
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