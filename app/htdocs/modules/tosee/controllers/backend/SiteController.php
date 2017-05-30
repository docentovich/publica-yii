<?php
namespace modules\tosee\controllers\backend;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use modules\tosee\services\postService as Post;


/**
 * Site controller
 */
class SiteController extends Controller
{

    public $layout = "@templates/main/backend/layouts/main";


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
                        'actions' => ['editor', 'moderator', 'director'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
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
            ],
        ];
    }



    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionEditor()
    {
        return $this->render('editor');
    }


    public function actionDirector()
    {
        return $this->render('administrator');
    }

    public function actionModerator()
    {
        return $this->render('moderator');
    }



    /**
     * Login action.
     *
     * @return string

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
     */


}
