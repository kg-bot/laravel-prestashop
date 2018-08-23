<?php
/**
 * Created by PhpStorm.
 * User: nts
 * Date: 1.4.18.
 * Time: 00.01
 */

namespace PrestaShop\Builders;


use PrestaShop\Models\ProductCategory;

class ProductCategoryBuilder extends Builder
{

    protected $entity        = 'categories';
    protected $model         = ProductCategory::class;
    protected $detailsEntity = 'categories';
    protected $primaryKey    = 'id';
}