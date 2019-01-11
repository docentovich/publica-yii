<?php

namespace orders;

use orders\controllers\OrdersController;
use orders\services\OrdersService;
use probank\services\ProbankSpecialistsService;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap ( $app )
    {
        $app->getUrlManager()->addRules(
            [
                'order/<portfolio_id:\d+>/<customer_id:\d+>' => 'orders/orders/order',
                'order/<portfolio_id:\d+>' => 'orders/orders/order',
                'order/<order_id:\d+>/<action:[\w\-]+>' => 'orders/orders/<action>',
            ]
        );

        \Yii::$container->setSingleton('ordersService', [
            'class' => OrdersService::class,
        ]);
        $ordersService = \Yii::$container->get('ordersService');

        \Yii::$container->setDefinitions([
            OrdersController::class => [
                'ordersService' => $ordersService,
            ],
        ]);
    }
}