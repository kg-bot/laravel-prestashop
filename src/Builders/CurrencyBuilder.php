<?php
/**
 * Created by PhpStorm.
 * User: nts
 * Date: 31.3.18.
 * Time: 15.37
 */

namespace PrestaShop\Builders;

use PrestaShop\Models\Currency;

class CurrencyBuilder extends Builder
{
    protected $entity        = 'currencies';
    protected $detailsEntity = 'currencies';
    protected $primaryKey    = 'id';
    protected $model         = Currency::class;
}