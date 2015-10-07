<?php

namespace Openl10n\Sdk;

use GuzzleHttp\Client;
use Openl10n\Sdk\EntryPoint\EntryPointInterface;

class Api
{
    protected $client;

    public function __construct(Config $config)
    {
        if (!$config->getHostname()) {
            throw \InvalidArgumentException('hostname must be set');
        }
        $options = [
            'scheme' =>  $config->getUseSsl() ? 'https' : 'http',
            'hostname' =>  $config->getHostname(),
            'port' =>  $config->getPort(),
        ];

        $baseUri = vsprintf('%s://%s:%s/api/', $options);


        $this->client = new Client([
            'base_uri' => $baseUri,
            'auth' =>  [$config->getLogin(), $config->getPassword()],
            'auth' =>  [$config->getLogin(), $config->getPassword()],
            'expect' => false,
            'headers' => [
                'Accept' => 'application/json',
                'User-Agent' => 'Openl10n '.\GuzzleHttp\default_user_agent()
            ]
        ]);

        $this->registerDefaultEntryPoints();
    }

    public function getClient()
    {
        return $this->client;
    }

    public function addEntryPoint(EntryPointInterface $entryPoint)
    {
        $entryPoint->setClient($this->client);
        $this->entryPoints[$entryPoint->getName()] = $entryPoint;
    }

    public function getEntryPoint($name)
    {
        if (!isset($this->entryPoints[$name])) {
            throw new \InvalidArgumentException(sprintf('Invalid entry point "%s"', $name));
        }

        return $this->entryPoints[$name];
    }

    protected function registerDefaultEntryPoints()
    {
        $entryPoints = array(
            new EntryPoint\ProjectEntryPoint(),
            new EntryPoint\ResourceEntryPoint(),
            new EntryPoint\TranslationEntryPoint(),
        );

        foreach ($entryPoints as $entryPoint) {
            $this->addEntryPoint($entryPoint);
        }
    }
}
