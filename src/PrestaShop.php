<?php
/**
 * Created by PhpStorm.
 * User: nts
 * Date: 31.3.18.
 * Time: 15.12
 */

namespace PrestaShop;

use PrestaShop\Builders\CustomerBuilder;
use PrestaShop\Builders\CustomerGroupBuilder;
use PrestaShop\Builders\OrderBuilder;
use PrestaShop\Builders\ProductBuilder;
use PrestaShop\Builders\ProductCategoryBuilder;
use PrestaShop\Builders\StockAvailableBuilder;
use PrestaShop\Builders\SupplierBuilder;
use PrestaShop\Utils\Request;

class PrestaShop
{
    /**
     * @var $request Request
     */
    protected $request;

    /**
     * Rackbeat constructor.
     *
     * @param null  $token   API token
     * @param array $options Custom Guzzle options
     * @param array $headers Custom Guzzle headers
     */
    public function __construct( $token = null, $store_url = null, $options = [], $headers = [] )
    {
        $this->initRequest( $token, $store_url, $options, $headers );
    }

    private function initRequest( $token, $store_url, $options = [], $headers = [] )
    {
        $this->request = new Request( $token, $store_url, $options, $headers );
    }

    public function customers()
    {
        return new CustomerBuilder( $this->request );
    }

    public function customer_groups()
    {
        return new CustomerGroupBuilder( $this->request );
    }

    public function orders()
    {
        return new OrderBuilder( $this->request );
    }

    public function products()
    {
        return new ProductBuilder( $this->request );
    }

    public function product_categories()
    {
        return new ProductCategoryBuilder( $this->request );
    }

    public function suppliers()
    {
        return new SupplierBuilder( $this->request );
    }

    public function stock_availables()
    {
        return new StockAvailableBuilder( $this->request );
    }


}