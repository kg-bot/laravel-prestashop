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
    public function get( $filters = [], $details = false )
    {
        $urlFilters = '';

        if ( count( $filters ) > 0 ) {

            $urlFilters = '?filter=';
            $i          = 1;

            foreach ( $filters as $filter ) {

                $urlFilters .= $filter[ 0 ] . $this->switchComparison( $filter[ 1 ] ) .
                               $this->escapeFilter( $filter[ 2 ] ); // todo fix arrays aswell ([1,2,3,...] string)

                if ( count( $filters ) > $i ) {

                    $urlFilters .= '$and:'; // todo allow $or: also
                }

                $i++;
            }
        }

        return $this->request->handleWithExceptions( function () use ( $urlFilters, $details ) {

            $response = $this->request->client->get( [

                'resource' => $this->entity,
            ] );

            $response     = $response->children()->children();
            $fetchedItems = collect( json_decode( str_replace( PHP_EOL, '', json_encode( $response ) ) ) );

            $items = collect( [] );

            foreach ( $fetchedItems->first() as $index => $item ) {

                $identifier = ( (array) $item )[ '@attributes' ]->{$this->primaryKey};

                $item = [

                    $this->primaryKey => $identifier,
                ];

                /** @var Model $model */
                $model = new $this->model( $this->request, $item );

                $items->push( $model );


            }

            if ( $details ) {


                foreach ( $items as $index => $item ) {

                    $item = $this->find( $item->{$this->primaryKey} );

                    $items[ $index ] = $item;
                }
            }


            return $items;
        } );
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

            $response = $this->request->client->post( "{$this->entity}", [
                'json' => $data,
            ] );

            $responseData = collect( json_decode( (string) $response->getBody() ) );

            return new $this->model( $this->request, $responseData->first() );
        } );
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
}