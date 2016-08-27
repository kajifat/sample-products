<?php

namespace Kajifat\SampleProducts;

use Illuminate\Support\ServiceProvider;

class SampleProductsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (! $this->app->routesAreCached()) {
            require __DIR__.'/routes.php';
        }

        $this->loadViewsFrom(__DIR__.'/views', 'SampleProducts');

        $this->publishes([
           __DIR__.'/migrations' => database_path('/migrations'),
           __DIR__.'/views' => base_path('resources/views/vendor/SampleProducts'),
           __DIR__.'/assets' =>public_path('Kajifat/SampleProducts'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Kajifat\SampleProducts\ProductsController');
    }
}
