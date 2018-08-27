<?php
/**
 * Created by PhpStorm.
 * User: nts
 * Date: 31.3.18.
 * Time: 15.37
 */

namespace PrestaShop\Builders;

use PrestaShop\Models\Cart;

class CartBuilder extends Builder
{
    protected $entity        = 'carts';
    protected $detailsEntity = 'carts';
    protected $primaryKey    = 'id';
    protected $model         = Cart::class;
}