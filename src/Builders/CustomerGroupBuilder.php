<?php
/**
 * Created by PhpStorm.
 * User: nts
 * Date: 31.3.18.
 * Time: 15.37
 */

namespace PrestaShop\Builders;


use PrestaShop\Models\CustomerGroup;

class CustomerGroupBuilder extends Builder
{
    protected $entity        = 'groups';
    protected $detailsEntity = 'groups';
    protected $primaryKey    = 'id';
    protected $model         = CustomerGroup::class;
}