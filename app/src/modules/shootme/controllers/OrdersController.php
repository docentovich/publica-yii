<?php

namespace shootme\controllers;

use orders\dto\OrdersServiceConfig;
use orders\services\OrdersService;
use shootme\dto\ShootmeSpecialistsServiceConfig;
use shootme\dto\ShootmeSpecialistsTransportModel;
use shootme\services\ShootmeSpecialistsService;
use yii\filters\AccessControl;
use yii\web\Controller;

class OrdersController extends Controller
{
    public $layout = "@current_template/layouts/main";

    /** @var ShootmeSpecialistsService */
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

    private function getTransportModel($config): ShootmeSpecialistsTransportModel
    {
        return $this->specialistsService->action(new ShootmeSpecialistsServiceConfig($config));
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
            'action' => ShootmeSpecialistsService::ACTION_GET_BY_ID,
            'portfolio_id' => (int) $portfolio_id
        ]);
        return $this->render('date-time', [
            'specialistTransportModel' => $transportModel,
        ]);
    }
}