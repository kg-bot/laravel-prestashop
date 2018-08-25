<?php
/**
 * Created by PhpStorm.
 * User: nts
 * Date: 1.4.18.
 * Time: 00.01
 */

namespace PrestaShop\Builders;


use PrestaShop\Models\Employee;

class EmployeeBuilder extends Builder
{

    protected $entity        = 'employees';
    protected $detailsEntity = 'employees';
    protected $primaryKey    = 'id';
    protected $model         = Employee::class;
}