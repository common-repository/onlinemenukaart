<?php

namespace OnlineMenukaart\Http\Controllers;

class RequestAuthorizationController
{
    public function __invoke()
    {
        $query = http_build_query([
            'name'          => get_site_url(),
            'redirect_uri'  => site_url() . str_replace('request-auth', 'authorize', $_SERVER['REQUEST_URI']),
            'response_type' => 'code',
            'scopes[]'      => 'integrations:wordpress',
        ]);

        header('Location: '. ONLINEMENUKAART_API .'/authorize?' . $query);
        exit(0);
    }
}
