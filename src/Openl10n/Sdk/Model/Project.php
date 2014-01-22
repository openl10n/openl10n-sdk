<?php

namespace Openl10n\Sdk\Model;

use Guzzle\Service\Command\ResponseClassInterface;
use Guzzle\Service\Command\OperationCommand;

class Project implements ResponseClassInterface
{
    protected $slug;
    protected $name;
    protected $defaultLocale;

    public static function fromCommand(OperationCommand $command)
    {
        $content = $command->getResponse()->getBody();
        $attributes = json_decode($content, true);

        if (null === $attributes) {
            throw new \RuntimeException('Unable to parse body content');
        }

        $project = new self($attributes['slug']);
        $project->name = $attributes['name'];
        $project->defaultLocale = $attributes['default_locale'];

        return $project;
    }

    public function __construct($slug)
    {
        $this->slug = $slug;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getDefaultLocale()
    {
        return $this->defaultLocale;
    }

    public function setDefaultLocale($defaultLocale)
    {
        $this->defaultLocale = $defaultLocale;

        return $this;
    }
}
