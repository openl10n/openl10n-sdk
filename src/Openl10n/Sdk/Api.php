<?php

namespace Openl10n\Sdk;

use Guzzle\Common\Collection;
use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;
use Openl10n\Sdk\Model\Project;

class Api
{
    protected $client;

    public function __construct(array $options, Client $client = null)
    {
        $this->client = $client ?: new Client();

        $defaultOptions = array(
            'base_url' => '{scheme}://{hostname}/api',
            'scheme'   => 'http',
            //'base_url' => '{scheme}://{hostname}/api/{version}',
            //'version' => '1',
        );

        $requiredOptions = array(
            'hostname',
            'username',
            'password',
        );

        $options = Collection::fromConfig($options, $defaultOptions, $requiredOptions);
        $this->client->setConfig($options);
        $this->client->setBaseUrl($options->get('base_url'));
        $this->client->setDefaultOption('auth', array(
            $options['username'],
            $options['password'],
            'Basic'
        ));

        $description = ServiceDescription::factory(__DIR__.'/Resources/service.php');
        $this->client->setDescription($description);
    }

    public function getClient()
    {
        return $this->client;
    }

    public function getProjects()
    {
        $command = $this->client->getCommand('ListProjects');

        return $this->client->execute($command);
    }

    public function getProject($projectSlug)
    {
        $command = $this->client->getCommand('GetProject', array(
            'projectSlug' => $projectSlug,
        ));

        return $this->client->execute($command);
    }

    public function createProject(Project $project)
    {
        $command = $this->client->getCommand('CreateProject', array(
            'slug' => $project->getSlug(),
            'name' => $project->getName(),
            'defaultLocale' => $project->getDefaultLocale(),
        ));

        $this->client->execute($command);
    }

    public function updateProject(Project $project)
    {
        $command = $this->client->getCommand('EditProject', array(
            'projectSlug' => $project->getSlug(),
            'name' => $project->getName(),
            'defaultLocale' => $project->getDefaultLocale(),
        ));

        $this->client->execute($command);
    }

    public function deleteProject($projectSlug)
    {
        $command = $this->client->getCommand('DeleteProject', array(
            'projectSlug' => $projectSlug,
        ));

        return $this->client->execute($command);
    }

    public function getLanguages($projectSlug)
    {
        $command = $this->client->getCommand('ListLanguages', array(
            'projectSlug' => $projectSlug,
        ));

        return $this->client->execute($command);
    }

    public function getLanguage($projectSlug, $locale)
    {
        $command = $this->client->getCommand('GetLanguage', array(
            'projectSlug' => $projectSlug,
            'locale' => $locale,
        ));

        return $this->client->execute($command);
    }

    public function createLanguage($projectSlug, $locale)
    {
        $command = $this->client->getCommand('CreateLanguage', array(
            'projectSlug' => $projectSlug,
            'locale' => $locale,
        ));

        $this->client->execute($command);
    }

    public function deleteLanguage($projectSlug, $locale)
    {
        $command = $this->client->getCommand('DeleteLanguage', array(
            'projectSlug' => $projectSlug,
            'locale' => $locale,
        ));

        $this->client->execute($command);
    }

    public function importFile($projectSlug, \SplFileInfo $file, $domainSlug, $locale, array $options = array())
    {
        $command = $this->client->getCommand('ImportDomain', array(
            'projectSlug' => $projectSlug,
            'domain' => $domainSlug,
            'locale' => $locale,
            'file' => '@'.$file->getRealPath(),
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
        ));
        $response = $this->client->execute($command);

        return $response->getBody(true);
    }
}
