<?php
/**
 * Created by PhpStorm.
 * User: nts
 * Date: 1.4.18.
 * Time: 00.02
 */

namespace PrestaShop\Models;


use PrestaShop\Utils\Model;

class ProductCategory extends Model
{
    protected $entity     = 'categories';
    protected $primaryKey = 'id';
}