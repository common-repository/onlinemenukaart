<?php

namespace OnlineMenukaart;

use Illuminate\Container\Container;
use OnlineMenukaart\Http\Router;
use OnlineMenukaart\Providers\ApiServiceProvider;
use OnlineMenukaart\Providers\BlockEditorServiceProvider;
use OnlineMenukaart\Providers\OnlineMenukaartServiceProvider;
use OnlineMenukaart\Providers\RouteServiceProvider;

class Plugin
{
    /**
     * @const string
     */
    const OPTION_NAME = 'omk_settings';

    /**
     * @var Container
     */
    protected $container;

    /**
     * @var string[]
     */
    protected $providers = [
        OnlineMenukaartServiceProvider::class,
        BlockEditorServiceProvider::class,
        RouteServiceProvider::class,
        ApiServiceProvider::class,
    ];

    public function __construct($path)
    {
        $this->container = Container::getInstance();

        $this->container->bind(Container::class, function () {
            return Container::getInstance();
        });

        $this->container->bind('path', function () use ($path) {
            return realpath($path) . '/';
        });
    }

    /**
     * @param string     $name
     * @param mixed|null $default
     *
     * @return mixed|null
     */
    public static function option($name, $default = null)
    {
        $options = get_option(self::OPTION_NAME);

        return isset($options[$name]) ? $options[$name] : $default;
    }

    /**
     * @return string|null
     */
    public static function token()
    {
        return static::option('omk_api_token');
    }

    public function boot()
    {
        foreach ($this->providers as $provider) {
            $this->container->make($provider)->register();
        }
    }

    public function start()
    {
        $this->boot();

        $this->container->make(Router::class)->dispatch();
    }
}
