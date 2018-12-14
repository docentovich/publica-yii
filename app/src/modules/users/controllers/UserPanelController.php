<?php

namespace app\modules\users\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

class UserPanelController extends Controller
{
    public $layout = "@current_template/layouts/user";

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
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['comments'],
                        'allow' => true,
                        'roles' => ['user'],
                    ],
                ],
            ],
        ];
    }

    public function actionComments()
    {
        return $this->render('comments', ['comments' => \Yii::$app->user->identity->myComments]);
    }
}