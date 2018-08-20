<?php
/**
 * Created by PhpStorm.
 * User: nts
 * Date: 31.3.18.
 * Time: 16.53
 */

namespace PrestaShop\Utils;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use PrestaShop\Exceptions\PrestaShopClientException;
use PrestaShop\Exceptions\PrestaShopRequestException;

class Request
{
    /**
     * @var \GuzzleHttp\Client
     */
    public $client;

    /**
     * Request constructor.
     *
     * @param null  $token
     * @param array $options
     * @param array $headers
     */
    public function __construct( $token = null, $store_url = null, $options = [], $headers = [] )
    {
        $token        = $token ?? config( 'laravel-prestashop.token' );
        $store_url    = $store_url ?? config( 'laravel-prestashop.store_url' );
        $headers      = array_merge( $headers, [

            'Accept'       => 'application/json',
            'Content-Type' => 'application/json',
        ] );
        $options      = array_merge( $options, [

            'auth'     => [ '', $token ],
            'base_uri' => $store_url . '/api/',
            'headers'  => $headers,
        ] );
        $this->client = new Client( $options );
    }

    /**
     * @param $callback
     *
     * @return mixed
     * @throws \Rackbeat\Exceptions\RackbeatClientException
     * @throws \Rackbeat\Exceptions\RackbeatRequestException
     */
    public function handleWithExceptions( $callback )
    {
        try {
            return $callback();

        } catch ( ClientException $exception ) {

            $message = $exception->getMessage();
            $code    = $exception->getCode();

            if ( $exception->hasResponse() ) {

                $message = (string) $exception->getResponse()->getBody();
                $code    = $exception->getResponse()->getStatusCode();
            }

            throw new PrestaShopClientException( $message, $code );

        } catch ( ServerException $exception ) {

            $message = $exception->getMessage();
            $code    = $exception->getCode();

            if ( $exception->hasResponse() ) {

                $message = (string) $exception->getResponse()->getBody();
                $code    = $exception->getResponse()->getStatusCode();
            }

            throw new PrestaShopRequestException( $message, $code );

        } catch ( \Exception $exception ) {

            $message = $exception->getMessage();
            $code    = $exception->getCode();

            throw new PrestaShopClientException( $message, $code );
        }
    }
}