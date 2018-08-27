<?php
/**
 * Created by PhpStorm.
 * User: nts
 * Date: 31.3.18.
 * Time: 15.37
 */

namespace PrestaShop\Builders;

use PrestaShop\Models\Carrier;

class CarrierBuilder extends Builder
{
    protected $entity        = 'carriers';
    protected $detailsEntity = 'carriers';
    protected $primaryKey    = 'id';
    protected $model         = Carrier::class;
}