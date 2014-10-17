<?php

namespace Openl10n\Sdk\EntryPoint;

use Openl10n\Sdk\Model\Project;

class ProjectEntryPoint extends AbstractEntryPoint
{
    public function getName()
    {
        return 'project';
    }

    public function findAll()
    {
        return $this->getClient()->get("projects")->json();
    }

    public function get($slug)
    {
        return $this->getClient()->get("projects/$slug")->json();
    }

    public function create(array $data)
    {
        $response = $this->getClient()->post('projects', [
            'headers' => ['Content-Type' => 'application/json'],
            'body'    => json_encode($data),
        ]);

        return $response->json();
    }

    public function update($slug, array $data)
    {
        $this->getClient()->put('projects/'.$slug, [
            'headers' => ['Content-Type' => 'application/json'],
            'body'    => json_encode($data),
        ]);
    }

    public function delete($slug)
    {
        $this->getClient()->delete('projects/'.$slug);
    }

    public function getLanguages($projectSlug)
    {
        $response = $this->getClient()->get("projects/$projectSlug/languages");

        return $response->json();
    }

    public function addLanguage($projectSlug, $locale)
    {
        $this->getClient()->post('projects/'.$projectSlug.'/languages', [
            'headers' => ['Content-Type' => 'application/json'],
            'body'    => json_encode(['locale' => $locale]),
        ]);
    }

    public function deleteLanguage($projectSlug, $locale)
    {
        $this->getClient()->delete('projects/'.$projectSlug.'/languages/'.$locale);
    }
}
