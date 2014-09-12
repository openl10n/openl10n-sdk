<?php

namespace Openl10n\Sdk;

use GuzzleHttp\Client;
use GuzzleHttp\Collection;
use Openl10n\Sdk\EntryPoint\EntryPointInterface;

class Api
{
    protected $client;

    public function __construct(Config $config)
    {
        $defaultOptions = [
            'scheme' => 'http',
        ];

        $requiredOptions = [
            'hostname',
        ];

        $options = [
            'hostname' =>  $config->getHostname(),
            'scheme' =>  $config->getUseSsl() ? 'https' : 'http',
            'port' =>  $config->getPort(),
        ];

        $options = Collection::fromConfig($options, $defaultOptions, $requiredOptions);

        $this->client = new Client([
            'base_url' => ['{scheme}://{hostname}:{port}/api/', $options->toArray()],
            'defaults' => [
                'auth' =>  [$config->getLogin(), $config->getPassword()],
                'expect' => false,
                'headers' => [
                    'Accept' => 'application/json',
                    'User-Agent' => 'Openl10n '.Client::getDefaultUserAgent()
                ]
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
