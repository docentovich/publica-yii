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
use Symfony\Component\Finder\Exception\AccessDeniedException;
use yii\web\NotFoundHttpException;

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
    private function prepareGetOrderByCSId(OrdersServiceConfig $config)
    {
        return Orders::find()
            ->customerId($config->customer_id)
            ->portfolioId($config->portfolio_id);
    }

    /**
     * @param OrdersServiceConfig $config
     * @return \src\models\OrdersQuery
     */
    private function prepareGetOrderByOrderId(OrdersServiceConfig $config)
    {
        return Orders::find()
            ->orderId($config->customer_id);
    }

    /**
     * @param OrdersServiceConfig $config
     * @param bool $throwException
     * @return \app\models\Orders|array|null
     */
    private function findOneOrder(OrdersServiceConfig $config, $throwException = true)
    {
        $order = $this->prepareGetOrderByOrderId($config)->one();

        if (!$order && $throwException) {
            throw new ElementNotFound('order not found');
        }

        return $order;
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
        $order = $this->prepareGetOrderByCSId($config)->one()
            ?? new Orders([
                'portfolio_id' => $config->portfolio_id,
                'customer_id' => $config->customer_id
            ]);

        return new OrdersTransportModel(new OrdersConfigQuery($config), $order);
    }

    /**
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
     * @param OrdersServiceConfig $config
     * @param Orders $order
     */
    private function helperSavePersonalPlanner(OrdersServiceConfig $config, Orders &$order)
    {
        foreach ($config->time as $time){ // save time to personal planner of saller
            try{
                $dtp = new OrdersDateTimePlanner([
                    'user_id' => $order->seller->id,
                    'date' => $config->date->format('Y-m-d'),
                    'time' => $time
                ]);
                if($dtp->validate() && $dtp->save()){
                    $order->link('dateTimePlanner', $dtp);
                }

            }catch (\Exception $e){

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
     * @param OrdersServiceConfig $config
     * @return OrdersTransportModel
     */
    private function actionSendMessage(OrdersServiceConfig $config)
    {
        if($config->order_id === null){ // first message creates the order
            $order = $this->helperFindOrCreateOrder($config);
        } else { // second message
            $order = $this->findOneOrder($config);
        }

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
     * @param OrdersServiceConfig $config
     * @return OrdersTransportModel
     */
    private function actionCompleteOrder(OrdersServiceConfig $config)
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