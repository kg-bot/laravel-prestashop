<?php
/**
 * Created by PhpStorm.
 * User: nts
 * Date: 1.4.18.
 * Time: 00.01
 */

namespace PrestaShop\Builders;


use PrestaShop\Models\Product;

class ProductBuilder extends Builder
{

    protected $entity        = 'products';
    protected $detailsEntity = 'products';
    protected $primaryKey    = 'id';
    protected $model         = Product::class;
}