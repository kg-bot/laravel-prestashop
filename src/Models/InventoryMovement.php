<?php
/**
 * Created by PhpStorm.
 * User: nts
 * Date: 19.4.18.
 * Time: 01.30
 */

namespace Rackbeat\Models;


use Rackbeat\Utils\Model;

class InventoryMovement extends Model
{
    protected $entity     = 'inventory-movements';
    protected $primaryKey = 'id';
}