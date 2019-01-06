<?php

namespace users\controllers;

use users\models\UsersOrders;
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
                'class' => VerbFilter::class,
                'actions' => [
                    'create' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['user'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $myOrdersModel = new UsersOrders(['myId' => \Yii::$app->user->getId()]);
        return $this->render('orders-list', [
            "orders" => $myOrdersModel->allOrders()->all(),
            "sales" => $myOrdersModel->allSales()->all(),
        ]);
    }

    public function actionShowMy()
    {

    }
}