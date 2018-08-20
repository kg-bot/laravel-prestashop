<?php
/**
 * Created by PhpStorm.
 * User: nts
 * Date: 19.4.18.
 * Time: 01.32
 */

namespace Rackbeat\Builders;


use Rackbeat\Models\Order;

class OrderBuilder extends Builder
{
    protected $entity = 'orders';
    protected $model  = Order::class;
}