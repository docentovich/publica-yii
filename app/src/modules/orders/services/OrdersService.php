<?php

namespace orders\services;

use orders\dto\OrdersConfigQuery;
use orders\dto\OrdersServiceConfig;
use orders\dto\OrdersTransportModel;
use app\services\BaseOrdersService;
use Codeception\Exception\ElementNotFound;
use orders\models\Orders;
use orders\models\OrdersDateTimePlanner;
use orders\models\OrdersSpecialistPortfolio;
use src\models\OrdersMessages;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use yii\web\NotFoundHttpException;

class OrdersService extends BaseOrdersService
{
    /** @var int
     *  @see OrdersService::actionOpenOrder
     */
    const ACTION_OPEN_ORDER = 1;

    /** @var int
     *  @see OrdersService::actionGetOrder
     */
    const ACTION_GET_ORDER = 2;

    /** @var int
     *  @see OrdersService::actionSendMessage
     */
    const ACTION_SEND_MESSAGE = 3;

    /** @var int
     *  @see OrdersService::actionCompleteOrder
     */
    const ACTION_COMPLETE_ORDER = 4;

    /** @var int
     *  @see OrdersService::actionFinalOrder
     */
    const ACTION_FINAL_ORDER = 5;

    /** @var int
     *  @see OrdersService::actionGetMyOrders
     */
    const ACTION_GET_MY_ORDERS = 6;

    /** @var int
     *  @see OrdersService::actionGetOrderByCSId
     */
    const ACTION_GET_ORDER_BY_CSID = 7;

    /**
     * @param OrdersServiceConfig $config
     * @return OrdersTransportModel
     * @throws \yii\base\ExitException
     */
    public function action(\app\interfaces\config $config): \app\dto\TransportModel
    {
        switch ($config->action) {
            case self::ACTION_OPEN_ORDER:
                return $this->actionOpenOrder($config);
            case self::ACTION_GET_ORDER:
                return $this->actionGetOrder($config);
            case self::ACTION_SEND_MESSAGE:
                return $this->actionSendMessage($config);
            case self::ACTION_COMPLETE_ORDER:
                return $this->actionCompleteOrder($config);
            case self::ACTION_FINAL_ORDER:
                return $this->actionFinalOrder($config);
            case self::ACTION_GET_MY_ORDERS:
                return $this->actionGetMyOrders($config);
            case self::ACTION_GET_ORDER_BY_CSID:
                return $this->actionGetOrderByCSId($config);
        }
    }


    /**
     * Find order by customer_id and portfolio_id
     *
     * @param OrdersServiceConfig $config
     * @return OrdersTransportModel
     */
    private function actionGetOrderByCSId(OrdersServiceConfig $config)
    {
        $order = $this->prepareGetOrderByCSId($config)->one();
        return new OrdersTransportModel(new OrdersConfigQuery($config), $order);
    }

    /**
     * Create order if not exist and return order.
     * $config must contain $config->portfolio_id $config->customer_id
     *
     * @param OrdersServiceConfig $config
     * @return OrdersTransportModel
     */
    private function actionOpenOrder(OrdersServiceConfig $config)
    {
        if (!isset($config->portfolio_id) || !isset($config->customer_id)) {
            throw new \InvalidArgumentException('portfolio_id and customer_id must be set');
        }

        /** @var OrdersDateTimePlanner $order */
        $order = $this->prepareGetOrderByCSId($config)->one() ?? $this->helperFindOrCreateOrder($config);

        return new OrdersTransportModel(new OrdersConfigQuery($config), $order);
    }

    /**
     * Find Order. if null Create Order
     *
     * @param OrdersServiceConfig $config
     * @return Orders|null
     */
    private function helperFindOrCreateOrder(OrdersServiceConfig $config)
    {
        if (!isset($config->portfolio_id) || !isset($config->customer_id)) {
            throw new \InvalidArgumentException('customer and seller must be different');
        }

        /** @var Orders */
        $order = $this->prepareGetOrderByCSId($config)->one() ?? $this->helperCreateOrder($config);

        return $order;
    }

    /**
     * Create Order
     *
     * @param OrdersServiceConfig $config
     * @return Orders
     */
    private function helperCreateOrder(OrdersServiceConfig $config)
    {
        if (!\Yii::$app->user->can('user')) {
            throw new AccessDeniedException();
        }
        $order = new Orders([
            'scenario' => Orders::SCENARIO_CREATE,
            'portfolio_id' => $config->portfolio_id,
            'customer_id' => $config->customer_id
        ]);

        if (!$order->validate() || !$order->save()) {
            throw new \InvalidArgumentException('invalid final message');
        }

        $this->helperSavePersonalPlanner($config, $order);

        return $order;
    }

    /**
     * Save Personal Planner
     * TODO use DateTimePlanner module service
     *
     * @param OrdersServiceConfig $config
     * @param Orders $order
     */
    private function helperSavePersonalPlanner(OrdersServiceConfig $config, Orders &$order)
    {
        foreach ($config->time as $time) { // save time to personal planner of saller
            try {
                $dtp = new OrdersDateTimePlanner([
                    'user_id' => $order->seller->id,
                    'date' => $config->date->format('Y-m-d'),
                    'time' => $time
                ]);
                if ($dtp->validate() && $dtp->save()) {
                    $order->link('dateTimePlanner', $dtp);
                }

            } catch (\Exception $e) {

            }
        }
    }

    /**
     * Return existed order by $config->order_id
     *
     * @param OrdersServiceConfig $config
     * @return OrdersTransportModel
     */
    private function actionGetOrder(OrdersServiceConfig $config)
    {
        $order = $this->findOneOrder($config);
        return new OrdersTransportModel(new OrdersConfigQuery($config), $order);
    }

    /**
     * Send Message (Ajax or ...)
     *
     * @param OrdersServiceConfig $config
     * @return OrdersTransportModel
     */
    private function actionSendMessage(OrdersServiceConfig $config)
    {
        $order = $this->findOneOrder($config);

        ($orderMessage = new OrdersMessages([
            'order_id' => $config->order_id,
            'owner_id' => \Yii::$app->user->getId()
        ]))->load(\Yii::$app->request->post());

        if ($orderMessage->validate() && $orderMessage->save()) {
            $order->link('orderMessages', $orderMessage);

            return new OrdersTransportModel(
                new OrdersConfigQuery($config),
                $orderMessage->toArray()
            );
        }

        throw new \InvalidArgumentException('invalid message');
    }

    /**
     * @param  OrdersServiceConfig $config
     * @return OrdersTransportModel
     */
    private function actionFinalOrder(OrdersServiceConfig $config)
    {
        $order = $this->findOneOrder($config);

        if (\Yii::$app->user->can('manageOrder', ['order_id' => $config->order_id])) {
            $order->status = $order::STATUS_FINISHED;
            $order->save();
        }
        return new OrdersTransportModel(new OrdersConfigQuery($config), $order);

    }

    /**
     * Return finished order. if user can edit then
     *
     * @param OrdersServiceConfig $config
     * @return OrdersTransportModel
     * @throws NotFoundHttpException
     */
    private function actionCompleteOrder(OrdersServiceConfig $config)
    {
        $order = Orders::find()->finished()->orderId($config->order_id)->one();

        if($order === null){
            throw new NotFoundHttpException();
        }

        if( \Yii::$app->request->post('send_form') !== null ){
            if (\Yii::$app->user->can('manageOrder', ['order_id' => $config->order_id])) {

                if ($order->load(\Yii::$app->request->post()) && $order->validate()) {
                    $order->save();
                }
            }
        }


        return new OrdersTransportModel(new OrdersConfigQuery($config), $order);
    }


    private function actionGetMyOrders($config)
    {

    }

    /**
     * @param OrdersServiceConfig $config
     * @return \src\models\OrdersQuery
     */
    private function prepareGetOrderByCSId(OrdersServiceConfig $config)
    {
        return Orders::find()
            ->customerId($config->customer_id)
            ->portfolioId($config->portfolio_id);
    }

    /**
     * Find order by order_id
     *
     * @param OrdersServiceConfig $config
     * @param bool $throwException
     * @return \app\models\Orders|array|null
     */
    private function findOneOrder(OrdersServiceConfig $config, $throwException = true)
    {
        $order = Orders::find()->orderId($config->order_id)->one();

        if (!$order && $throwException) {
            throw new ElementNotFound('order id');
        }

        return $order;
    }
}