<?php
/**
 * Created by PhpStorm.
 * User: nts
 * Date: 19.4.18.
 * Time: 01.32
 */

namespace PrestaShop\Builders;


use PrestaShop\Models\Order;

class OrderBuilder extends Builder
{
    protected $entity        = 'orders';
    protected $model         = Order::class;
    protected $detailsEntity = 'order_details';
    protected $primaryKey    = 'id';
}