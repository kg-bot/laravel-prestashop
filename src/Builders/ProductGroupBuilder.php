<?php
/**
 * Created by PhpStorm.
 * User: nts
 * Date: 1.4.18.
 * Time: 00.01
 */

namespace Rackbeat\Builders;


use Rackbeat\Models\ProductGroup;

class ProductGroupBuilder extends Builder
{

    protected $entity = 'product-groups';
    protected $model  = ProductGroup::class;
}