<?php

namespace Openl10n\Sdk\Response;

use Guzzle\Service\Command\ResponseClassInterface;
use Guzzle\Service\Command\OperationCommand;
use Openl10n\Sdk\Model\Project;

class GetProject implements ResponseClassInterface
{
    public static function fromCommand(OperationCommand $command)
    {
        $content = $command->getResponse()->getBody();
        $attributes = json_decode($content, true);

        if (null === $attributes) {
            throw new \RuntimeException('Unable to parse body content');
        }

        $project = new Project($attributes['slug']);
        $project->setName($attributes['name']);
        $project->setDefaultLocale($attributes['default_locale']);

        return $project;
    }
}
