<?php

namespace OnlineMenukaart\Http\Api;

use OnlineMenukaart\Plugin;

class OnlineMenukaartApi
{
    /**
     * @return array
     */
    public function getIntegrations()
    {
        $response = wp_remote_request(constant('ONLINEMENUKAART_API') . '/api/integrations/wordpress', [
            'sslverify' => false,
            'headers'   => [
                'Authorization' => 'Bearer ' . Plugin::token(),
            ]
        ]);

        if ($response['response']['code'] !== 200) {
            return [];
        }

        return json_decode($response['body'], true)['data'];
    }

    public function getIntegrationList()
    {
        $integrations = [];
        foreach ($this->getIntegrations() as $integration) {
            $integrations[] = [
                'value' => $integration['uuid'],
                'label' => $integration['name'],
            ];
        }

        return $integrations;
    }
}
