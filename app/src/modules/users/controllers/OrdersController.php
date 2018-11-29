<?php

namespace app\modules\users\controllers;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class OrdersController extends UserPanelController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'create' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['show-my'],
                        'allow' => true,
                        'roles' => ['user'],
                    ],
                    [
                        'actions' => ['show'],
                        'allow' => true,
                        'roles' => ['administrator'],
                    ],
                ],
            ],
        ];
    }

    public function actionShow()
    {

    }
    public function actionShowMy()
    {

    }
}