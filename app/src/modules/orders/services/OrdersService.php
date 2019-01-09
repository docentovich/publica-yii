<?php

namespace orders\services;

use orders\dto\OrdersConfigQuery;
use orders\dto\OrdersServiceConfig;
use orders\dto\OrdersTransportModel;
use app\services\BaseOrdersService;
use Codeception\Exception\ElementNotFound;
use orders\models\Orders;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class OrdersService extends BaseOrdersService
{
    const ACTION_OPEN_ORDER = 1;
    const ACTION_GET_ORDER = 2;
    const ACTION_SEND_MESSAGE = 3;
    const ACTION_COMPLETE_ORDER = 4;
    const ACTION_FINAL_ORDER = 5;
    const ACTION_GET_MY_ORDERS = 6;

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
        }
    }

    /**
     * @param OrdersServiceConfig $config
     * @return \src\models\OrdersQuery
     */
    private function prepareGetOrderByCSId($config)
    {
        Orders::find()
            ->customerId($config->customer_id)
            ->sellerId($config->seller_id);
    }

    /**
     * @param OrdersServiceConfig $config
     * @return \src\models\OrdersQuery
     */
    private function prepareGetOrderByOrderId($config)
    {
        Orders::find()
            ->orderId($config->customer_id);
    }

    /**
     * @param OrdersServiceConfig $config
     * @param bool $throwException
     * @return \app\models\Orders|array|null
     */
    private function findOneOrder($config, $throwException = true)
    {
        $order = $this->prepareGetOrderByOrderId($config)->one();

        if (!$order && $throwException) {
            throw new ElementNotFound('order not found');
        }

        return $order;
    }

    /**
     * Create order if not exist and return order.
     * $config must contain $config->seller_id $config->customer_id
     *
     * @param OrdersServiceConfig $config
     * @return OrdersTransportModel
     */
    private function actionOpenOrder($config)
    {
        if ($config->seller_id === $config->customer_id) {
            throw new \InvalidArgumentException('customer and seller must be different');
        }

        $order = $this->prepareGetOrderByCSId($config)->one();

        if ($order === null) {
            if (!\Yii::$app->user->can('user')) {
                throw new AccessDeniedException();
            }
            $order = new Orders([
                'scenario' => Orders::SCENARIO_CREATE,
                'seller_id' => $config->seller_id,
                'customer_id' => $config->customer_id
            ]);

            if (!$order->validate() || !$order->save()) {
                throw new \InvalidArgumentException('invalid final message');
            }
        }

        return new OrdersTransportModel(new OrdersConfigQuery($config), $order);
    }

    /**
     * Return existed order by $config->order_id
     *
     * @param OrdersServiceConfig $config
     * @return OrdersTransportModel
     */
    private function actionGetOrder($config)
    {
        $order = $this->findOneOrder($config);
        return new OrdersTransportModel(new OrdersConfigQuery($config), $order);
    }

    /**
     * @param OrdersServiceConfig $config
     * @return OrdersTransportModel
     */
    private function actionSendMessage($config)
    {
        $order = $this->findOneOrder($config);

        ($orderMessage = $order->orderMessagesNN)->load(\Yii::$app->request->post());

        if ($orderMessage->validate() && $orderMessage->save()) {
            $order->link('orderMessages', $orderMessage);
            return new OrdersTransportModel(
                new OrdersConfigQuery($config),
                $order->toArray([], ['messages'])
            );
        }
        throw new \InvalidArgumentException('invalid message');
    }

    /**
     * @param  OrdersServiceConfig $config
     * @return OrdersTransportModel
     */
    private function actionFinalOrder($config)
    {
        $order = $this->findOneOrder($config);

        if (\Yii::$app->user->can('manageOrder', ['order_id' => $config->order_id])) {
            $order->status = $order::STATUS_FINISHED;
            $order->save();
        }
        return new OrdersTransportModel(new OrdersConfigQuery($config), $order);

    }

    /**
     * @param OrdersServiceConfig $config
     * @return OrdersTransportModel
     */
    private function actionCompleteOrder($config)
    {
        $order = $this->findOneOrder($config);

        if ($order->load(\Yii::$app->request->post())) {
            if (!\Yii::$app->user->can('manageOrder', ['order_id' => $config->order_id])) {
                throw new AccessDeniedException();
            }

            if($order->validate()){
                $order->save();
            }
        }

        return new OrdersTransportModel(new OrdersConfigQuery($config), $order);
    }


    private function actionGetMyOrders($config)
    {

    }
}