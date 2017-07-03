<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        Route::pattern('id', '[0-9]+');

        Route::pattern('params', '[a-zA-Z/]+');

        Route::pattern('menuId', '[0-9]+');
        Route::pattern('restockingId', '[0-9]+');
        Route::pattern('accessoryId', '[0-9]+');
        Route::pattern('subcategoryId', '[0-9]+');
        Route::pattern('categoryId', '[0-9]+');
        Route::pattern('productId', '[0-9]+');
        Route::pattern('orderId', '[0-9]+');
        Route::pattern('orderProductId', '[0-9]+');
        Route::pattern('eventProductId', '[0-9]+');
        Route::pattern('staffId', '[0-9]+');
        Route::pattern('customerId', '[0-9]+');
        Route::pattern('eventId', '[0-9]+');

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
