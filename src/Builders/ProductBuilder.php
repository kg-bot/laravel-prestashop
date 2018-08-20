<?php
/**
 * Created by PhpStorm.
 * User: nts
 * Date: 1.4.18.
 * Time: 00.01
 */

namespace Rackbeat\Builders;


use Rackbeat\Models\Product;

class ProductBuilder extends Builder
{

    protected $entity = 'products';
    protected $model  = Product::class;
}