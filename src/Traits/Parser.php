<?php
/**
 * Created by PhpStorm.
 * User: kgbot
 * Date: 8/23/18
 * Time: 9:14 AM
 */

namespace PrestaShop\Traits;


use SimpleXMLElement;

trait Parser
{
    function arrayToXml( SimpleXMLElement $object, array $data )
    {
        foreach ( $data as $key => $value ) {
            if ( is_numeric( $key ) ) {
                $key = str_singular( $key );
            }
            if ( is_array( $value ) ) {
                $new_object = $object->addChild( $key );
                $this->arrayToXml( $new_object, $value );
            } else {
                $object->addChild( $key, $value );
            }
        }
    }

    protected function xmlToArray( $xml )
    {
        $json  = json_encode( (array) $xml );
        $array = json_decode( $json, true );

        return $array;
    }
}