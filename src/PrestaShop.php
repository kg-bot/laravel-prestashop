<?php
/**
 * Created by PhpStorm.
 * User: nts
 * Date: 31.3.18.
 * Time: 15.12
 */

namespace PrestaShop;

use PrestaShop\Builders\AddressBuilder;
use PrestaShop\Builders\CarrierBuilder;
use PrestaShop\Builders\CartBuilder;
use PrestaShop\Builders\CurrencyBuilder;
use PrestaShop\Builders\CustomerBuilder;
use PrestaShop\Builders\CustomerGroupBuilder;
use PrestaShop\Builders\EmployeeBuilder;
use PrestaShop\Builders\LanguageBuilder;
use PrestaShop\Builders\OrderBuilder;
use PrestaShop\Builders\OrderStateBuilder;
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
     * @param null $token API token
     * @param null $store_url
     * @param array $options Custom Guzzle options
     * @param array $headers Custom Guzzle headers
     * @param null $debug
     */
    public function __construct($token = null, $store_url = null, $options = [], $headers = [], $debug = null)
    {
        $this->initRequest($token, $store_url, $options, $headers, $debug);
    }

    private function initRequest($token, $store_url, $options = [], $headers = [], $debug = null)
    {
        $this->request = new Request($token, $store_url, $options, $headers, $debug);
    }

    /**
     * @return CustomerBuilder
     */
    public function customers()
    {
        return new CustomerBuilder($this->request);
    }

    /**
     * @return CustomerGroupBuilder
     */
    public function customer_groups()
    {
        return new CustomerGroupBuilder($this->request);
    }

    /**
     * @return OrderBuilder
     */
    public function orders()
    {
        return new OrderBuilder($this->request);
    }

    /**
     * @return OrderStateBuilder
     */
    public function order_states()
    {
        return new OrderStateBuilder($this->request);
    }

    /**
     * @return ProductBuilder
     */
    public function products()
    {
        return new ProductBuilder($this->request);
    }

    /**
     * @return ProductCategoryBuilder
     */
    public function product_categories()
    {
        return new ProductCategoryBuilder($this->request);
    }

    /**
     * @return SupplierBuilder
     */
    public function suppliers()
    {
        return new SupplierBuilder($this->request);
    }

    /**
     * @return StockAvailableBuilder
     */
    public function stock_availables()
    {
        return new StockAvailableBuilder($this->request);
    }

    /**
     * @return EmployeeBuilder
     */
    public function employees()
    {
        return new EmployeeBuilder($this->request);
    }

    /**
     * @return AddressBuilder
     */
    public function addresses()
    {
        return new AddressBuilder($this->request);
    }

    /**
     * @return CartBuilder
     */
    public function carts()
    {
        return new CartBuilder($this->request);
    }

    /**
     * @return CurrencyBuilder
     */
    public function currencies()
    {
        return new CurrencyBuilder($this->request);
    }

    /**
     * @return LanguageBuilder
     */
    public function languages()
    {
        return new LanguageBuilder($this->request);
    }

    /**
     * @return CarrierBuilder
     */
    public function carriers()
    {
        return new CarrierBuilder($this->request);
    }


}