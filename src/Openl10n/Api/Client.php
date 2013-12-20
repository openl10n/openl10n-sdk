<?php

namespace Openl10n\Api;

use Guzzle\Common\Collection;
use Guzzle\Service\Client as GuzzleClient;
use Guzzle\Service\Description\ServiceDescription;

class Client extends GuzzleClient
{
    /**
     * Build the client from given configuration.
     *
     * @param array $data configuration
     */
    public function __construct($data = array())
    {
        $default = array(
            'base_url' => '{scheme}://{hostname}/api',
            'scheme'   => 'http',
        );

        $required = array(
            'hostname',
            'login',
            'password',
        );

        // Add a HTTP Basic auth
        if (isset($data['login']) && isset($data['password'])) {
            $default['request.options'] = array('auth' => array(
                $data['login'],
                $data['password'],
                'Basic'
            ));
        }

        $config = Collection::fromConfig($data, $default, $required);

        parent::__construct($config->get('base_url'), $config);

        $description = ServiceDescription::factory(__DIR__.'/Resources/service.php');
        $this->setDescription($description);
    }
}
