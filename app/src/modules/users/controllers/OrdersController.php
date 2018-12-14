<?php

namespace app\modules\users\controllers;

use app\models\Orders;
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
        $myOrdersModel = new Orders(['myId' => \Yii::$app->user->getId()]);
        return $this->render('orders-list', [
            "orders" => $myOrdersModel->allOrders()->all(),
            "sales" => $myOrdersModel->allSales()->all(),
        ]);
    }

    public function actionShowMy()
    {

    }
}