<?php

namespace Openl10n\Sdk;

use GuzzleHttp\Client;
use GuzzleHttp\Collection;
use Openl10n\Sdk\EntryPoint;
use Openl10n\Sdk\EntryPoint\EntryPointInterface;
use Openl10n\Sdk\Model\Project;

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
        ];

        $options = Collection::fromConfig($options, $defaultOptions, $requiredOptions);

        $this->client = new Client([
            'base_url' => ['{scheme}://{hostname}/api/', $options->toArray()],
            'defaults' => [
                'auth' =>  [$config->getLogin(), $config->getPassword()]
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









    public function importFile($projectSlug, \SplFileInfo $file, $domainSlug, $locale, array $options = array())
    {
        $command = $this->client->getCommand('ImportDomain', array(
            'projectSlug' => $projectSlug,
            'domain' => $domainSlug,
            'locale' => $locale,
            'file' => '@'.$file->getRealPath(),
            'options' => $options,
        ));

        $this->client->execute($command);
    }

    public function exportFile($projectSlug, $domainSlug, $locale, $format, array $options = array())
    {
        $command = $this->client->getCommand('ExportDomain', array(
            'project' => $projectSlug,
            'domain' => $domainSlug,
            'locale' => $locale,
            'format' => $format,
            'options' => $options,
        ));
        $response = $this->client->execute($command);

        return $response->getBody(true);
    }
}
