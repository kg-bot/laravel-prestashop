<?php
/**
 * Created by PhpStorm.
 * User: nts
 * Date: 31.3.18.
 * Time: 15.37
 */

namespace PrestaShop\Builders;


use PrestaShop\Models\Supplier;

class SupplierBuilder extends Builder
{
    protected $entity        = 'suppliers';
    protected $model         = Supplier::class;
    protected $detailsEntity = 'suppliers';
    protected $primaryKey    = 'id';
}