<?php

namespace OnlineMenukaart\Shortcodes;

use eftec\bladeone\BladeOne;
use OnlineMenukaart\Plugin;

class MenuCardShortcode implements Shortcode
{
    /**
     * @var BladeOne
     */
    private $view;

    public function __construct(BladeOne $view)
    {
        $this->view = $view;
    }

    /**
     * @param array $attributes
     *
     * @return string
     */
    public function __invoke(array $attributes)
    {
        wp_enqueue_script('iframe-resizer',plugins_url('onlinemenukaart/dist/iframe-resizer.js'));

        return $this->view->run('shortcodes.menucard', [
            'uuid'  => $attributes['uuid'],
            'token' => Plugin::token(),
        ]);
    }
}
