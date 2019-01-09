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
    const ACTION_GET_ORDER = 1;
    const ACTION_SEND_MESSAGE = 2;
    const ACTION_COMPLETE_ORDER = 3;
    const ACTION_FINAL_ORDER = 4;
    const ACTION_GET_MY_ORDERS = 5;

    /**
     * @param OrdersServiceConfig $config
     * @return OrdersTransportModel
     * @throws \yii\base\ExitException
     */
    public function action(\app\interfaces\config $config): \app\dto\TransportModel
    {
        switch ($config->action) {
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
    private function prepareGetOrderQuery($config)
    {
        return  Orders::find()
            ->customerId($config->customer_id)
            ->sellerId($config->seller_id);
    }

    /**
     * @param OrdersServiceConfig $config
     * @return OrdersTransportModel
     */
    private function actionGetOrder($config)
    {
        if($config->seller_id === $config->customer_id){
            throw new \InvalidArgumentException('customer and seller must be different');
        }

        $order = $this->prepareGetOrderQuery($config)->one();

        if($order === null){
            if(!\Yii::$app->user->can('user')){
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
     * @param OrdersServiceConfig $config
     * @return OrdersTransportModel
     */
    private function actionSendMessage($config)
    {
        $order = $this->prepareGetOrderQuery($config)->one();
        if(!$order){
            throw new ElementNotFound('order not found');
        }
        ($orderMessage = $order->orderMessagesNN)->load(\Yii::$app->request->post());

        if($orderMessage->validate() && $orderMessage->save()){
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
        $order = ($this->prepareGetOrderQuery($config)->one());
        if(!$order){
            throw new ElementNotFound('order not found');
        }
        $order->load(\Yii::$app->request->post());
        if($order->validate() && $order->save()){
            return new OrdersTransportModel(new OrdersConfigQuery($config), $order);
        }
        throw new \InvalidArgumentException('invalid final message');
    }

    /**
     * @param OrdersServiceConfig $config
     * @return OrdersTransportModel
     */
    private function actionCompleteOrder($config)
    {
        $order = ($this->prepareGetOrderQuery($config)->one());
        $order->status = Orders::STATUS_FINISHED;
        $order->save();
        return new OrdersTransportModel(new OrdersConfigQuery($config),  $order);
    }



    private function actionGetMyOrders($config)
    {

    }
}