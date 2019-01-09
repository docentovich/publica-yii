<?php

namespace orders\controllers;

use app\dto\OrdersServiceConfig;
use orders\dto\OrdersTransportModel;
use orders\models\Orders;
use orders\services\OrdersService;
use yii\filters\AccessControl;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

class OrdersController extends Controller
{
    /** @var OrdersService */
    protected $ordersService;

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
                        'roles' => ['user', 'complete'],
                        'actions' => ['order']
                    ],
                    [
                        'allow' => true,
                        'actions' => ['send-message'],
                        'matchCallback' => function () {
                            return \Yii::$app->user->can('sendMessageOrder', [
                                'order_id' => \Yii::$app->request->get('order_id')
                            ]);
                        },
                    ],
                    [
                        'allow' => true,
                        'actions' => ['finish'],
                        'matchCallback' => function () {
                            return \Yii::$app->user->can('manageOrder', [
                                'order_id' => \Yii::$app->request->get('order_id')
                            ]);
                        },
                    ]
                ],
            ],
        ];
    }

    public function getOrdersService()
    {
        return $this->ordersService;
    }

    public function setOrdersService($ordersService)
    {
        $this->ordersService = $ordersService;
    }

    /**
     * @param array $config = [
     *      'seller_id' => 1,
     *      'customer_id' => 1,
     *      'action'   => 1,
     * ]
     * @return OrdersTransportModel
     * @throws \yii\base\ExitException
     */
    private function getTransportModel($config = []): OrdersTransportModel
    {
        return $this->ordersService->action(new OrdersServiceConfig($config));
    }

    public function actionOrder($seller_id, $customer_id = null)
    {
        $customer_id = $customer_id ?? \Yii::$app->user->getId();
        $orderTransportModel = $this->getTransportModel([
            'action' => OrdersService::ACTION_GET_ORDER,
            'seller_id' => $seller_id,
            'customer_id' => $customer_id
        ]);
        if ($orderTransportModel->result->status === Orders::STATUS_FINISHED) {
            $this->redirect(['orders/complete']);
        }
        return $this->render('order-chat', compact('orderTransportModel'));
    }

    public function actionSendMessage($order_id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (!\Yii::$app->request->isAjax) {
            throw new BadRequestHttpException('request must be ajax');
        }
        $owner_id = \Yii::$app->user->getId();
        $transportModel = $this->getTransportModel([
            'action' => OrdersService::ACTION_SEND_MESSAGE,
            'order_id' => $order_id,
            'owner_id' => $owner_id
        ]);

        return $transportModel->result;
    }

    public function actionFinish($order_id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (!\Yii::$app->request->isAjax) {
            throw new BadRequestHttpException('request must be ajax');
        }
        $transportModel = $this->getTransportModel([
            'action' => OrdersService::ACTION_COMPLETE_ORDER,
            'order_id' => $order_id,
        ]);

        if ($transportModel->result) {
            $this->redirect(['orders/orders/compete']);
            \Yii::$app->end();
        }
        throw new \HttpException();
    }

    public function actionComplete($order_id)
    {
        return $this->render('complete', [
            'orderTransportModel' => $this->getTransportModel([
                'action' => OrdersService::ACTION_GET_ORDER,
                'order_id' => $order_id,
            ])
        ]);
    }
}