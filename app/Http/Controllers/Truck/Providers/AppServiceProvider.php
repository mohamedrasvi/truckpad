<?php

namespace App\Http\Controllers\Truck\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 * @Module App\Http\Controllers\Truck\Providers
 */
class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->routes();

    }

    protected function routes()
    {
        $this->registerV1Routes();
    }

    protected function registerDefaultRoutes()
    {
        $this->defaultRouter();
    }

    protected function registerV1Routes()
    {
        $this->app->router->group(['prefix' => 'api/v1'], function () {
            $this->registerDefaultRoutes();
        });
    }

    protected function defaultRouter()
    {
        $this->app->router->group(['namespace' => 'App\Http\Controllers\Truck'], function ($router) {
            require __DIR__ . '/../Routes/routes.php';
        });
    }


}
