<?php

namespace OnlineMenukaart\Providers;

use eftec\bladeone\BladeOne;
use Illuminate\Container\Container;
use OnlineMenukaart\Shortcodes\MenuCardShortcode;

class OnlineMenukaartServiceProvider
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
        $this->container->bind(BladeOne::class, function (Container $container) {
            return new BladeOne(
                $container['path'] . 'views',
                $container['path'] . 'cache',
                BladeOne::MODE_AUTO
            );
        });

        $this->styles();
        $this->shortcodes();
    }

    private function styles()
    {
        wp_register_style('onlinemenukaart', plugins_url('onlinemenukaart/dist/onlinemenukaart.css'));
        wp_enqueue_style('onlinemenukaart');
    }

    protected function shortcodes()
    {
        add_shortcode('menucard', $this->container[MenuCardShortcode::class]);
        add_shortcode('menukaart', $this->container[MenuCardShortcode::class]);
    }
}