<?php
/**
 * Created by PhpStorm.
 * User: nts
 * Date: 31.3.18.
 * Time: 15.37
 */

namespace Rackbeat\Builders;


use Rackbeat\Models\Supplier;

class SupplierBuilder extends Builder
{
    protected $entity = 'suppliers';
    protected $model  = Supplier::class;
}