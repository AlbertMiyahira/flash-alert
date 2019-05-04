<?php

namespace AlbertMiyahira\FlashAlert;

use Illuminate\Support\ServiceProvider;

/**
 * Class FlashAlertServiceProvider
 * @package AlbertMiyahira\FlashAlert
 */
class FlashAlertServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $dir = rtrim(strtr(__DIR__, '\\', '/'), '/');
        // config
        $this->publishes([
            $dir . '/config/flash_alert.php' => config_path('flash_alert.php'),
        ]);
        // view
        $this->loadViewsFrom($dir . '/resources/views', 'flash_alert');
        $this->publishes([
            $dir . '/resources/views' => resource_path('views/vendor/flash_alert'),
        ]);
        // trans
        $this->loadTranslationsFrom($dir . '/resources/lang', 'flash_msg');
        $this->publishes([
            $dir . '/resources/lang/ja' => resource_path('lang/ja'),
            $dir . '/resources/lang/en' => resource_path('lang/en'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(FlashAlert::class, function ($app) {
            return new FlashAlert(config('FlashAlert'));
        });
    }

    /**
     * Get the services provided by the provider.[vendor.laravel_fla
     *
     * @return array
     */
    public function provides()
    {
        return ['FlashAlert'];
    }

}