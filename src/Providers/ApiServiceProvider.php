<?php

namespace OnlineMenukaart\Providers;

use Illuminate\Container\Container;
use OnlineMenukaart\Http\Api\OnlineMenukaartApi;

class ApiServiceProvider
{
    /**
     * @const string
     */
    const API_NAMESPACE = 'onlinemenukaart';

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
        add_action('rest_api_init', function () {
            register_rest_route(
                self::API_NAMESPACE,
                '/wordpress-integrations',
                [
                    'methods'  => 'GET',
                    'callback' => function () {
                        return $this->container->make(OnlineMenukaartApi::class)->getIntegrationList();
                    },
                ]
            );
        });
    }
}
