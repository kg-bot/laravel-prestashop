<?php
/**
 * Created by PhpStorm.
 * User: nts
 * Date: 31.3.18.
 * Time: 15.37
 */

namespace PrestaShop\Builders;

use PrestaShop\Models\Address;

class AddressBuilder extends Builder
{
    protected $entity        = 'addresses';
    protected $detailsEntity = 'addresses';
    protected $primaryKey    = 'id';
    protected $model         = Address::class;
}