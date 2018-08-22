<?php
/**
 * Created by PhpStorm.
 * User: nts
 * Date: 31.3.18.
 * Time: 16.53
 */

namespace PrestaShop\Utils;


use PrestaShop\Classes\PrestaShopClass;
use PrestaShop\Classes\PrestaShopWebserviceException;

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
        $token     = $token ?? config( 'laravel-prestashop.token' );
        $store_url = $store_url ?? config( 'laravel-prestashop.store_url' );

        $this->client = new PrestaShopClass( $store_url, $token, true );
    }

    /**
     * @param $callback
     *
     * @return mixed
     * @throws \PrestaShop\Classes\PrestaShopWebserviceException
     */
    public function handleWithExceptions( $callback )
    {
        try {
            return $callback();

        } catch ( PrestaShopWebserviceException $exception ) {

            $message = $exception->getMessage();
            $code    = $exception->getCode();

            throw new PrestaShopWebserviceException( $message, $code );

        } catch ( \Exception $exception ) {

            $message = $exception->getMessage();
            $code    = $exception->getCode();

            throw new PrestaShopWebserviceException( $message, $code );
        }
    }
}