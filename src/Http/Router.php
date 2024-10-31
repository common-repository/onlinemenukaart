<?php

namespace OnlineMenukaart\Http;

use Illuminate\Container\Container;

class Router
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * @var array
     */
    protected $routes = [
        'GET'      => [],
        'POST'     => [],
        'fallback' => null,
    ];

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @param string|callable $callback
     *
     * @return $this
     */
    public function fallback($callback)
    {
        $this->routes['fallback'] = $callback;

        return $this;
    }

    /**
     * @param string          $name
     * @param string|callable $callback
     *
     * @return $this
     */
    public function get($name, $callback)
    {
        $this->routes['GET'][$name] = $callback;

        return $this;
    }

    /**
     * @param string          $name
     * @param string|callable $callback
     *
     * @return $this
     */
    public function post($name, $callback)
    {
        $this->routes['POST'][$name] = $callback;

        return $this;
    }

    public function dispatch()
    {
        $page   = isset($_GET['route']) ? sanitize_text_field($_GET['route']) : null;
        $method = $_SERVER['REQUEST_METHOD'] === 'POST' ? 'POST' : 'GET';

        $resolver = isset($this->routes[$method][$page]) ? $this->routes[$method][$page] : $this->routes['fallback'];

        return $this->container->call(
            $this->container->make($resolver)
        );
    }
}
