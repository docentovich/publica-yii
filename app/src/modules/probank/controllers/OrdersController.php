<?php

namespace probank\controllers;

use orders\dto\OrdersServiceConfig;
use orders\services\OrdersService;
use probank\dto\ProbankSpecialistsServiceConfig;
use probank\dto\ProbankSpecialistsTransportModel;
use probank\services\ProbankSpecialistsService;
use yii\filters\AccessControl;
use yii\web\Controller;

class OrdersController extends Controller
{
    public $layout = "@current_template/layouts/main";

    /** @var ProbankSpecialistsService */
    protected $specialistsService;
    /** @var \orders\services\OrdersService */
    protected $ordersService;

    public function setSpecialistsService($specialistsService)
    {
        $this->specialistsService = $specialistsService;
    }

    public function getSpecialistsService()
    {
        return $this->specialistsService;
    }

    public function setOrdersService($ordersService)
    {
        $this->ordersService = $ordersService;
    }

    public function getOrdersService()
    {
        return $this->ordersService;
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
                        'allow' => true,
                        'roles' => ['user'],
                    ],
                ],
            ],
        ];
    }

    private function getTransportModel($config): ProbankSpecialistsTransportModel
    {
        return $this->specialistsService->action(new ProbankSpecialistsServiceConfig($config));
    }

    /**
     * Show Page with DateTime widget.
     * If order is exist go to /orders/orders/order
     *
     * @param $portfolio_id
     * @return string
     * @throws \yii\base\ExitException
     */
    public function actionDateTime($portfolio_id)
    {
        $ordersTransport = $this->ordersService->action(new  OrdersServiceConfig([
            'action' => OrdersService::ACTION_GET_ORDER_BY_CSID,
            'customer_id' => \Yii::$app->user->getId(),
            'portfolio_id' => $portfolio_id
        ]));
        if($ordersTransport->result !== null){ // if order already exist
            $this->redirect([
                '/orders/orders/order',
                'portfolio_id' => $portfolio_id,
                'customer_id' => \Yii::$app->user->getId()
            ]);
            \Yii::$app->end();
        }

        $transportModel = $this->getTransportModel([
            'action' => ProbankSpecialistsService::ACTION_GET_BY_ID,
            'portfolio_id' => (int) $portfolio_id
        ]);
        return $this->render('date-time', [
            'specialistTransportModel' => $transportModel,
        ]);
    }
}