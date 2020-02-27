<?php
/**
 * Created by PhpStorm.
 * User: nts
 * Date: 19.4.18.
 * Time: 01.30
 */

namespace PrestaShop\Models;


use PrestaShop\Utils\Model;

class OrderState extends Model
{
    protected $entity = '/order_states';
    protected $primaryKey = 'id';
}