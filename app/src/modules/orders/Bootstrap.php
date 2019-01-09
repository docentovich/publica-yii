<?php

namespace orders;

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
                'order/<seller_id:\d+>/<order_id:\d+>' => 'orders/orders/order',
                'order/<order_id:\d+>/<action:[\w\-]+>' => 'orders/orders/<action>',
            ]
        );
    }
}