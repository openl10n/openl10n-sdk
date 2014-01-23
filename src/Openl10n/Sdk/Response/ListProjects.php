<?php

namespace Openl10n\Sdk\Response;

use Guzzle\Service\Command\ResponseClassInterface;
use Guzzle\Service\Command\OperationCommand;
use Openl10n\Sdk\Model\Project;

class ListProjects implements ResponseClassInterface
{
    public static function fromCommand(OperationCommand $command)
    {
        $content = $command->getResponse()->getBody();
        $results = json_decode($content, true);

        if (null === $results) {
            throw new \RuntimeException('Unable to parse body content');
        }

        $projects = array();
        foreach ($results as $result) {
            $project = new Project($result['slug']);
            $project->setName($result['name']);
            $project->setDefaultLocale($result['default_locale']);

            $projects[] = $project;
        }

        return $projects;
    }
}
