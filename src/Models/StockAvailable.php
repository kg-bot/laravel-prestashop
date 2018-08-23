<?php
/**
 * Created by PhpStorm.
 * User: kgbot
 * Date: 8/23/18
 * Time: 12:07 PM
 */

namespace PrestaShop\Models;


use PrestaShop\Utils\Model;

class StockAvailable extends Model
{
    protected $primaryKey = 'id';
    protected $entity     = '/stock_availables';
}