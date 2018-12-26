<?php
namespace App\Helpers\AFIP;

use Illuminate\Support\ServiceProvider;

class AfipServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //include __DIR__ . '/routes.php';
        $this->loadViewsFrom(__DIR__ . '/Views', 'afip');
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('afip',function ($app) {
            return new AFIP;
        });

        $this->mergeConfig();
    }

    /**
     * Merges afip configs.
     *
     * @return void
     */
    private function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/config.php', 'afip'
        );
    }
}