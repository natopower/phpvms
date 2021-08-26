<?php

namespace Modules\VMSAcars\Providers;

use App\Services\ModuleService;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

/**
 *
 */
class VMSAcarsServiceProvider extends ServiceProvider
{
    private $moduleSvc;

    /**
     * Boot the application events.
     */
    public function boot()
    {
        $this->moduleSvc = app(ModuleService::class);

        $this->registerRoutes();
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();

        $this->registerLinks();

        $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        //
    }

    /**
     * Add module links here
     */
    public function registerLinks()
    {
        // Show this link if logged in
        // $this->moduleSvc->addFrontendLink('VMSAcars', '/vmsacars', '', $logged_in=true);

        // Admin links:
        $this->moduleSvc->addAdminLink('VMSAcars', '/admin/vmsacars');
    }

    /**
     * Register the routes
     */
    protected function registerRoutes()
    {
        /**
         * Routes for the admin
         */
        Route::group([
            'as' => 'vmsacars.',
            'prefix' => 'admin/vmsacars',
            'middleware' => ['web', 'role:admin'],
            'namespace' => '\Modules\VMSAcars\Http\Controllers\Admin'
        ], function() {
            # This is the admin path. Comment this out if you don't have an admin panel component.
            Route::group([], function () {
                Route::get('/', 'AdminController@index')->name('admin.index');
                Route::post('/config', 'AdminController@config')->name('admin.config');
                Route::post('/rules', 'AdminController@rules')->name('admin.rules');
            });
        });

        /**
         * Routes for an API
         */
        Route::group([
            'as' => 'vmsacars.',
            'prefix' => 'api/vmsacars',
            'middleware' => ['api'],
            'namespace' => '\Modules\VMSAcars\Http\Controllers\Api'
        ], function() {
            Route::group(['middleware' => []], function () {
                Route::get('/', 'ApiController@index');
            });

            /**
             * This is required to have a valid API key
             */
            Route::group([
                'middleware' => [
                    'api.auth'
                ]
            ], function () {
                Route::get('/config', 'ApiController@config');
                Route::get('/rules', 'ApiController@rules');
            });
        });
    }

    /**
     * Register config.
     */
    protected function registerConfig()
    {
        /*$this->publishes([
            __DIR__.'/../Config/config.php' => config_path('vmsacars.php'),
        ], 'vmsacars');

        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'vmsacars'
        );*/
    }

    /**
     * Register views.
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/vmsacars');
        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/vmsacars';
        }, \Config::get('view.paths')), [$sourcePath]), 'vmsacars');
    }

    /**
     * Register translations.
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/vmsacars');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'vmsacars');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'vmsacars');
        }
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides()
    {
        return [];
    }
}
