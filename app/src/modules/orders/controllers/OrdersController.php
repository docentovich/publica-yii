<?php

namespace orders\controllers;

use app\models\DateTimePlanner;
use orders\dto\OrdersServiceConfig;
use orders\dto\OrdersTransportModel;
use orders\models\Orders;
use orders\services\OrdersService;
use yii\base\Module;
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
                        'roles' => ['user'],
                        'actions' => ['order', 'complete']
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

    public function __construct(string $id, Module $module, OrdersService $ordersService, array $config = [])
    {
        $this->ordersService = $ordersService;
        parent::__construct($id, $module, $config);
    }

    /**
     * @param array $config = [
     *      'portfolio_id' => 1,
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

    private function getDefaultTime()
    {
        return '12-14';
    }

    /**
     * Open exist order or create. if order is finished then redirect to
     * /orders/orders/complete
     *
     * @param $portfolio_id
     * @param null $customer_id
     * @return string
     * @throws \yii\base\ExitException
     */
    public function actionOrder($portfolio_id, $customer_id = null)
    {
        $customer_id = $customer_id ?? \Yii::$app->user->getId();
        $date = new \DateTime(
            \Yii::$app->request->post('date')
                    ?? \Yii::$app->request->cookies->getValue('date')
                        ?? (new \DateTime())->format('Y-m-d')
        );
        $time = \Yii::$app->request->post('time')
                    ?? \Yii::$app->request->cookies->getValue('time')
                        ?? $this->getDefaultTime();

        $orderTransportModel = $this->getTransportModel([
            'action' => OrdersService::ACTION_OPEN_ORDER,
            'portfolio_id' => (int) $portfolio_id,
            'customer_id' => (int) $customer_id,
            'date' => $date,
            'time' => $time
        ]);

        if ($orderTransportModel->result->status === Orders::STATUS_FINISHED) {
            $this->redirect([
                '/orders/orders/complete',
                'order_id' => $orderTransportModel->result->id
            ]);
        }

        $city =  \app\models\City::findOne(["id" => \app\models\City::getCurrentCityId()]);

        return $this->render('order-chat', compact('orderTransportModel', 'city'));
    }

    /**
     * Ajax save message
     *
     * @param $order_id
     * @return array|null|Orders|Orders[]
     * @throws BadRequestHttpException
     * @throws \yii\base\ExitException
     */
    public function actionSendMessage($order_id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (!\Yii::$app->request->isAjax) {
            throw new BadRequestHttpException('request must be ajax');
        }
        $transportModel = $this->getTransportModel([
            'action' => OrdersService::ACTION_SEND_MESSAGE,
            'order_id' => $order_id,
        ]);

        return $transportModel->result;
    }

    /**
     * Change status of the order and redirect to
     * /orders/orders/complete
     *
     * @param $order_id
     * @throws \HttpException
     * @throws \yii\base\ExitException
     */
    public function actionFinish($order_id)
    {
        $transportModel = $this->getTransportModel([
            'action' => OrdersService::ACTION_FINISH_ORDER,
            'order_id' => $order_id,
        ]);

        if ($transportModel->result) {
            $this->redirect(['/orders/orders/complete', 'order_id' => $order_id]);
            \Yii::$app->end();
        }
        throw new \HttpException();
    }

    /**
     * If we can change order then show order form.
     * Else show rate and final message
     *
     * @param $order_id
     * @return string
     * @throws \yii\base\ExitException
     */
    public function actionComplete($order_id)
    {
        $orderTransportModel = $this->getTransportModel([
            'action' => OrdersService::ACTION_COMPLETE_ORDER,
            'order_id' => $order_id,
        ]);

        return $this->render('complete', compact('orderTransportModel'));
    }
}