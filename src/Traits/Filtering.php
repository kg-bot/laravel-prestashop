<?php
/**
 * Created by PhpStorm.
 * User: kgbot
 * Date: 8/22/18
 * Time: 7:47 PM
 */

namespace PrestaShop\Traits;


trait Filtering
{
    public function prepareFilters( $filters )
    {
        $optFilters = [];

        if ( count( $filters ) ) {

            foreach ( $filters as $filter => $value ) {

                $optFilters[ 'filter[' . $filter . ']' ] = $value;
            }
        }

        return $optFilters;
    }
}