<?php

namespace app\modules\users\controllers;

use yii\filters\AccessControl;

class CommentsController extends UserPanelController
{
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
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['user'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('comments', [
            'comments' => \Yii::$app->user->identity->myComments
        ]);
    }
}