<?php

namespace OnlineMenukaart\Http\Controllers;

use eftec\bladeone\BladeOne;
use OnlineMenukaart\Http\Api\OnlineMenukaartApi;
use OnlineMenukaart\Plugin;

class SettingsController
{
    /**
     * @var BladeOne
     */
    protected $view;

    /**
     * @var OnlineMenukaartApi
     */
    protected $api;

    public function __construct(BladeOne $view, OnlineMenukaartApi $api)
    {
        $this->view = $view;
        $this->api  = $api;
    }

    public function __invoke()
    {
        if(!current_user_can('manage_options')) {
            return;
        }

        add_action('admin_menu', function () {
            add_menu_page(
                'Online Menukaart',
                'Online Menukaart',
                'manage_options',
                'onlinemenukaart',
                function () {
                    echo $this->view->run('settings', [
                        'token'        => Plugin::token(),
                        'url'          => $_SERVER['REQUEST_URI'] . '&route=request-auth',
                        'integrations' => Plugin::token() ? $this->api->getIntegrations() : [],
                    ]);
                },
                'dashicons-onlinemenukaart'
            );
        });
    }
}
