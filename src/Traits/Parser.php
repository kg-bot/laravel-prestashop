<?php
/**
 * Created by PhpStorm.
 * User: kgbot
 * Date: 8/23/18
 * Time: 9:14 AM
 */

namespace PrestaShop\Traits;


trait Parser
{
    protected function xmlToArray( $xml )
    {
        $json  = json_encode( (array) $xml );
        $array = json_decode( $json, true );

        return $array;
    }

    protected function arrayToXml( $dom, $data )
    {
        if ( empty( $data[ 'name' ] ) ) {
            return false;
        }

        // Create the element
        $element_value = ( isset( $data[ 'value' ] ) ) ? $data[ 'value' ] : null;
        $element       = $dom->createElement( $data[ 'name' ], $element_value );

        // Add any attributes
        if ( !empty( $data[ 'attributes' ] ) && is_array( $data[ 'attributes' ] ) ) {
            foreach ( $data[ 'attributes' ] as $attribute_key => $attribute_value ) {
                $element->setAttribute( $attribute_key, $attribute_value );
            }
        }

        // Any other items in the data array should be child elements
        foreach ( $data as $data_key => $child_data ) {
            if ( !is_numeric( $data_key ) ) {
                continue;
            }

            $child = $this->arrayToXml( $dom, $child_data );
            if ( $child ) {
                $element->appendChild( $child );
            }
        }

        return $element;
    }
}