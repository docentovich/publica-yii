<?php

namespace app\dto;

use app\abstractions\ServiceConfig;

/**
 * Class OrdersServiceConfig
 * @property int $seller_id
 * @property int $portfolio_id
 * @property int $customer_id
 * @property int|null $order_id
 * @property int $owner_id
 * @property string $message
 * @property int $rate
 * @property \DateTime $date
 * @property array $time
 * @package app\dto
 */
class OrdersServiceConfig extends ServiceConfig
{
    public $order_id = null;
}