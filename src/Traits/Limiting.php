<?php
/**
 * Created by PhpStorm.
 * User: kgbot
 * Date: 8/22/18
 * Time: 7:49 PM
 */

namespace PrestaShop\Traits;


use PrestaShop\Classes\PrestaShopWebserviceException;

trait Limiting
{
    public function prepareLimit( $limits )
    {
        $optLimits = [];

        if ( is_array( $limits ) ) {

            if ( count( $limits ) === 2 ) {

                $optLimits[ 'limit' ] = $limits[ 0 ] . ',' . $limits[ 1 ];

            } else {

                throw new PrestaShopWebserviceException( 'If limit is array it must contain only 2 values, start and count, eg. [5,9]' );
            }

        } else if ( is_string( $limits ) || is_numeric( $limits ) ) {

            $optLimits[ 'limit' ] = $limits;


        } else {

            throw new PrestaShopWebserviceException( 'Limit can only be array or numeric string' );
        }

        return $optLimits;
    }
}