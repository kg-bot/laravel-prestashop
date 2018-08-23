<?php
/**
 * Created by PhpStorm.
 * User: kgbot
 * Date: 8/23/18
 * Time: 12:07 PM
 */

namespace PrestaShop\Builders;


use PrestaShop\Models\StockAvailable;

class StockAvailableBuilder extends Builder
{
    protected $entity        = 'stock_availables';
    protected $detailsEntity = 'stock_availables';
    protected $primaryKey    = 'id';
    protected $model         = StockAvailable::class;
}