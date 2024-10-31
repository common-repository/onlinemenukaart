<?php

namespace OnlineMenukaart\Providers;

use Illuminate\Container\Container;
use OnlineMenukaart\Http\Controllers\AuthorizeController;
use OnlineMenukaart\Http\Controllers\RequestAuthorizationController;
use OnlineMenukaart\Http\Controllers\SettingsController;
use OnlineMenukaart\Http\Router;

class RouteServiceProvider
{
    /**
     * @var Container
     */
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function register()
    {
        $this->container->singleton(Router::class, function () {
            $router = new Router($this->container);

            $router->get('authorize', AuthorizeController::class);
            $router->post('request-auth', RequestAuthorizationController::class);

            $router->fallback(SettingsController::class);

            return $router;
        });
    }
}