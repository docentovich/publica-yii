<?php

namespace app\modules\tosee\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\modules\tosee\services\backend\AdminService;


/**
 * Site controller
 */
class DirectorController extends Controller
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
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['administrator'],
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




    public function actionIndex()
    {
        $users = new AdminService;
        $post_requst = Yii::$app->request->post();
        if(isset($post_requst['setrule']))
        {
            $users->setUserRole($post_requst);
        }

        $users->getAllUsers();
        return $this->render('index',['users' => $users]);
    }


}
