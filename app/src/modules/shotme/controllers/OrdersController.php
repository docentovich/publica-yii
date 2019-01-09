<?php

namespace probank\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

class OrdersController extends Controller
{
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
                        'allow' => true,
                        'roles' => ['user'],
                    ],
                ],
            ],
        ];
    }
    public function actionCreate($sellers_portfolio_id)
    {

    }

    public function actionComplete($sellers_portfolio_id)
    {

    }

    public function actionRate($sellers_portfolio_id)
    {

    }

    public function actionProcess($sellers_portfolio_id)
    {

    }

    public function actionSalesOf($sellers_portfolio_id)
    {

    }
}