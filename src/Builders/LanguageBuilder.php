<?php
/**
 * Created by PhpStorm.
 * User: nts
 * Date: 31.3.18.
 * Time: 15.37
 */

namespace PrestaShop\Builders;

use PrestaShop\Models\Language;

class LanguageBuilder extends Builder
{
    protected $entity        = 'languages';
    protected $detailsEntity = 'languages';
    protected $primaryKey    = 'id';
    protected $model         = Language::class;
}