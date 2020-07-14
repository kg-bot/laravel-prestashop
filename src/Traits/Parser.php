<?php
/**
 * Created by PhpStorm.
 * User: kgbot
 * Date: 8/23/18
 * Time: 9:14 AM
 */

namespace PrestaShop\Traits;


use Illuminate\Support\Str;
use SimpleXMLElement;

trait Parser
{
	function arrayToXml( SimpleXMLElement $object, array $data, $parent_key = null ) {
		foreach ( $data as $key => $value ) {
			if ( is_numeric( $key ) && !is_null( $parent_key ) ) {
				$key = Str::singular( $parent_key );
			}
			if ( is_array( $value ) ) {
				$new_object = $object->addChild( $key );
				$this->arrayToXml( $new_object, $value, $key );
			} else {
				$object->addChild( $key, $value );
			}
		}
	}

	protected function xmlToArray( $xml ) {
		$json  = json_encode( (array) $xml );
		$array = json_decode( $json, true );

		return $array;
	}
}