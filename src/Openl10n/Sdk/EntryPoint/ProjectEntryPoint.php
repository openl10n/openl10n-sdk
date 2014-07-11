<?php

namespace Openl10n\Sdk\EntryPoint;

use Openl10n\Sdk\Model\Language;
use Openl10n\Sdk\Model\Project;

class ProjectEntryPoint extends AbstractEntryPoint
{
    public function getName()
    {
        return 'project';
    }

    public function findAll()
    {
        $results = $this->getClient()->get('projects')->json();

        $projects = array();
        foreach ($results as $result) {
            $project = new Project($result['slug']);
            $project->setName($result['name']);
            $project->setDefaultLocale($result['default_locale']);
            $project->setDescription($result['description']);

            $projects[] = $project;
        }

        return $projects;
    }

    public function get($slug)
    {
        $result = $this->getClient()->get('projects/'.$slug)->json();

        $project = new Project($result['slug']);
        $project->setName($result['name']);
        $project->setDefaultLocale($result['default_locale']);
        $project->setDescription($result['description']);

        return $project;
    }

    public function create(Project $project)
    {
        $this->getClient()->post('projects', [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode([
                'slug' => $project->getSlug(),
                'name' => $project->getName(),
                'default_locale' => $project->getDefaultLocale(),
                'description' => $project->getDescription(),
            ]),
        ]);
    }

    public function update(Project $project)
    {
        $this->getClient()->put('projects/'.$project->getSlug(), [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode([
                'name' => $project->getName(),
                'default_locale' => $project->getDefaultLocale(),
                'description' => $project->getDescription(),
            ]),
        ]);
    }

    public function delete($slug)
    {
        $this->getClient()->delete('projects/'.$slug);
    }

    public function getLanguages($projectSlug)
    {
        $results = $this->getClient()->get('projects/'.$projectSlug.'/languages')->json();

        return array_map(function ($result) {
            return new Language($result['locale'], $result['name']);
        }, $results);
    }

    public function addLanguage($projectSlug, $locale)
    {
        $this->getClient()->post('projects/'.$projectSlug.'/languages', [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode([
                'locale' => $locale,
            ]),
        ]);
    }

    public function deleteLanguage($projectSlug, $locale)
    {
        $this->getClient()->delete('projects/'.$projectSlug.'/languages/'.$locale);
    }
}
