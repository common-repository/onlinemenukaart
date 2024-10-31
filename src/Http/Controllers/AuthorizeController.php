<?php

namespace OnlineMenukaart\Http\Controllers;

class AuthorizeController
{
    public function __invoke()
    {
        if (!current_user_can('manage_options')) {
            trigger_error('Permission denied');

            return;
        }

        if (!isset($_GET['api_token'])) {
            trigger_error('Api token not given');
            return;
        }

        update_option('omk_settings', ['omk_api_token' => sanitize_text_field($_GET['api_token'])]);

        header('Location: ' . site_url() . '/wp-admin/admin.php?page=onlinemenukaart');
        exit(0);
    }
}
