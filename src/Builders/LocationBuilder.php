<?php
/**
 * Created by PhpStorm.
 * User: nts
 * Date: 31.3.18.
 * Time: 22.16
 */

namespace Rackbeat\Builders;


use Rackbeat\Models\Location;

class LocationBuilder extends Builder
{
    protected $entity = 'locations';
    protected $model  = Location::class;
}