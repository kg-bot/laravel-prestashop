<?php
/**
 * Created by PhpStorm.
 * User: nts
 * Date: 31.3.18.
 * Time: 17.03
 */

namespace PrestaShop\Utils;


use PrestaShop\Traits\Parser;
use ReflectionObject;
use ReflectionProperty;
use SimpleXMLElement;

class Model
{
    use Parser;

    protected $primaryKey;
    protected $entity;
    protected $modelClass = self::class;
    protected $fillable   = [];

    /**
     * @var Request
     */
    protected $request;

    public function __construct( Request $request, $data = [] )
    {
        $this->request = $request;
        $data          = (array) $data;

        foreach ( $data as $key => $value ) {

            $customSetterMethod = 'set' . ucfirst( camel_case( $key ) ) . 'Attribute';

            if ( !method_exists( $this, $customSetterMethod ) ) {

                $this->setAttribute( $key, $value );

            } else {

                $this->setAttribute( $key, $this->{$customSetterMethod}( $value ) );
            }
        }
    }

    protected function setAttribute( $attribute, $value )
    {
        $this->{$attribute} = ( $value instanceof SimpleXMLElement ) ? (string) $value : $value;
    }

    public function __toString()
    {
        return json_encode( $this->toArray() );
    }

    public function toArray()
    {
        $data       = [];
        $class      = new ReflectionObject( $this );
        $properties = $class->getProperties( ReflectionProperty::IS_PUBLIC );

        /** @var \ReflectionProperty $property */
        foreach ( $properties as $property ) {

            $data[ $property->getName() ] = $this->{$property->getName()};
        }

        return $data;
    }

    public function delete()
    {
        return $this->request->handleWithExceptions( function () {

            return $this->request->client->delete( [

                'resource' => $this->entity,
                'id'       => $this->{$this->primaryKey},
            ] );
        } );
    }

    public function update( $data = [] )
    {

        return $this->request->handleWithExceptions( function () use ( $data ) {

            $doc = new SimpleXMLElement( '<prestashop/>' );

            $this->arrayToXml( $doc, $data );

            $xml = $doc->asXML();

            /**
             * @var $response array|\SimpleXMLElement
             */
            $response = $this->request->client->edit( [

                'resource'      => $this->entity,
                'putXml'        => $xml,
                'id'            => $this->{$this->primaryKey},
                'output_format' => 'JSON',
            ] );

            if ( is_array( $response ) ) {

                $data = $response[ key( $response ) ];

            } else {

                $data = $this->xmlToArray( $response->children()->children() );
            }


            return new $this->modelClass( $this->request, $data );
        } );
    }

    public function getEntity()
    {
        return $this->entity;
    }

    public function setEntity( $new_entity )
    {
        $this->entity = $new_entity;
    }
}