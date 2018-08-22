<?php
/**
 * Created by PhpStorm.
 * User: nts
 * Date: 31.3.18.
 * Time: 17.00
 */

namespace PrestaShop\Builders;

use PrestaShop\Utils\Model;
use PrestaShop\Utils\Request;


class Builder
{
    protected $entity;
    /** @var Model */
    protected $model;
    private   $request;

    public function __construct( Request $request )
    {
        $this->request = $request;
    }

    /**
     * Get list of all entries, including details if you wish
     *
     * @param array $filters
     * @param bool  $details
     *
     * @return mixed
     * @throws \PrestaShop\Classes\PrestaShopWebserviceException
     */
    public function get( array $filters = [], bool $details = false )
    {
        $optFilters = [];

        if ( count( $filters ) ) {

            foreach ( $filters as $filter => $value ) {

                $optFilters[ 'filter[' . $filter . ']' ] = $value;
            }
        }

        return $this->request->handleWithExceptions( function () use ( $optFilters, $details ) {

            $opt = [

                'resource' => $this->entity,
            ];

            if ( count( $optFilters ) ) {

                $opt = array_merge( $opt, $optFilters );
            }

            $response = $this->request->client->get( $opt );

            $response     = $response->children()->children();
            $fetchedItems = collect( json_decode( str_replace( PHP_EOL, '', json_encode( $response ) ) ) );

            $items = collect( [] );

            if ( $fetchedItems->count() ) {
                foreach ( $fetchedItems->first() as $index => $item ) {

                    $identifier = ( isset( ( (array) $item )[ '@attributes' ] ) ) ?
                        ( (array) $item )[ '@attributes' ]->{$this->primaryKey} :
                        $item->{$this->primaryKey};

                    if ( $identifier ) {

                        $item = [

                            $this->primaryKey => $identifier,
                        ];

                        /** @var Model $model */
                        $model = new $this->model( $this->request, $item );

                        $items->push( $model );
                    }


                }

                if ( $details ) {


                    foreach ( $items as $index => $item ) {

                        $item = $this->find( $item->{$this->primaryKey} );

                        $items[ $index ] = $item;
                    }
                }
            }


            return $items;
        } );
    }

    public function find( $id )
    {
        return $this->request->handleWithExceptions( function () use ( $id ) {

            $response = $this->request->client->get( [

                'resource'        => $this->detailsEntity,
                $this->primaryKey => $id,
            ] );

            $response = $response->children();
            $response = $str = str_replace( PHP_EOL, '', json_encode( $response ) );
            //dd( $response->children()->children() );
            $responseData = collect( json_decode( $response ) );

            return new $this->model( $this->request, $responseData->first() );
        } );
    }

    public function create( $data )
    {
        return $this->request->handleWithExceptions( function () use ( $data ) {

            $blank = $this->request->client->get( [

                'url' => config( 'laravel-prestashop.store_url' ) . '/api/' . $this->entity . '?schema=blank',
            ] );

            if ( !isset( $data[ 'name' ] ) ) {

                $data[ 'name' ] = $blank->getName();
            }

            $doc = new \DOMDocument();

            $child = $this->arrayToXml( $doc, $data );

            if ( $child ) {
                $doc->appendChild( $child );
            }
            $doc->formatOutput = true; // Add whitespace to make easier to read XML
            $xml               = $doc->saveXML();

            $response = $this->request->client->add( [

                'resource' => $this->entity,
                'postXml'  => $xml,
            ] );

            dd( $response );

            $responseData = collect( json_decode( (string) $response->getBody() ) );

            return new $this->model( $this->request, $responseData->first() );
        } );
    }

    protected function arrayToXml( $dom, $data )
    {
        if ( empty( $data[ 'name' ] ) ) {
            return false;
        }

        // Create the element
        $element_value = ( !empty( $data[ 'value' ] ) ) ? $data[ 'value' ] : null;
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

    public function getEntity()
    {
        return $this->entity;
    }

    public function setEntity( $new_entity )
    {
        $this->entity = $new_entity;

        return $this->entity;
    }

    private function switchComparison( $comparison )
    {
        switch ( $comparison ) {
            case '=':
            case '==':
                $newComparison = '$eq:';
                break;
            case '!=':
                $newComparison = '$ne:';
                break;
            case '>':
                $newComparison = '$gt:';
                break;
            case '>=':
                $newComparison = '$gte:';
                break;
            case '<':
                $newComparison = '$lt:';
                break;
            case '<=':
                $newComparison = '$lte:';
                break;
            case 'like':
                $newComparison = '$like:';
                break;
            case 'in':
                $newComparison = '$in:';
                break;
            case '!in':
                $newComparison = '$nin:';
                break;
            default:
                $newComparison = "${$comparison}:";
                break;
        }

        return $newComparison;
    }

    private function escapeFilter( $variable )
    {
        $escapedStrings    = [
            "$",
            '(',
            ')',
            '*',
            '[',
            ']',
            ',',
        ];
        $urlencodedStrings = [
            '+',
            ' ',
        ];
        foreach ( $escapedStrings as $escapedString ) {

            $variable = str_replace( $escapedString, '$' . $escapedString, $variable );
        }
        foreach ( $urlencodedStrings as $urlencodedString ) {

            $variable = str_replace( $urlencodedString, urlencode( $urlencodedString ), $variable );
        }

        return $variable;
    }
}