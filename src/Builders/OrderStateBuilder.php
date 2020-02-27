<?php
/**
 * Created by PhpStorm.
 * User: nts
 * Date: 19.4.18.
 * Time: 01.32
 */

namespace PrestaShop\Builders;


use PrestaShop\Models\OrderState;

class OrderStateBuilder extends Builder
{
    protected $entity = 'order_states';
    protected $model = OrderState::class;
    protected $detailsEntity = 'order_states';
    protected $primaryKey = 'id';
}