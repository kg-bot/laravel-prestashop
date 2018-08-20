<?php
/**
 * Created by PhpStorm.
 * User: nts
 * Date: 2.4.18.
 * Time: 01.02
 */

namespace PrestaShop;


use Illuminate\Support\ServiceProvider;

class PrestaShopServiceProvider extends ServiceProvider
{
    /**
     * Boot.
     */
    public function boot()
    {
        $configPath = __DIR__ . '/config/laravel-prestashop.php';

        $this->mergeConfigFrom( $configPath, 'laravel-prestashop' );


        if ( function_exists( 'config_path' ) ) {

            $publishPath = config_path( 'laravel-prestashop.php' );

        } else {

            $publishPath = base_path( 'config/laravel-prestashop.php' );

        }

        $this->publishes( [ $configPath => $publishPath ], 'config' );
    }

    public function register()
    {
    }
}