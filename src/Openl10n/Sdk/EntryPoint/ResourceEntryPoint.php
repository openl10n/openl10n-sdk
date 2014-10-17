<?php

namespace Openl10n\Sdk\EntryPoint;

use Openl10n\Sdk\Model\Project;
use Openl10n\Sdk\Model\Resource;

class ResourceEntryPoint extends AbstractEntryPoint
{
    public function getName()
    {
        return 'resource';
    }

    public function findByProject($projectSlug)
    {
        $response = $this->getClient()->get("resources", [
            'query' => ['project' => $projectSlug],
        ]);

        return $response->json();
    }

    public function get($resourceId)
    {
        return $this->getClient()->get("resources/$resourceId")->json();
    }

    public function create(array $data)
    {
        $response = $this->getClient()->post('resources', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode($data),
        ]);

        return $response->json();
    }

    public function update($resourceId, array $data)
    {
        $this->getClient()->post('resources/'.$resource->getId(), [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode($data),
        ]);
    }

    public function delete($resourceId)
    {
        $this->getClient()->delete('resources/'.$resourceId);
    }

    public function upload($resourceId, $filepath, $locale, array $options = array())
    {
        $this->getClient()->post("resources/$resourceId/import", [
            'body' => [
                'locale' => $locale,
                'file' => fopen($filepath, 'r'),
                'options' => $options,
            ],
        ]);
    }

    public function download(Resource $resource, $locale, array $options = array(), $format = null)
    {
        $response = $this->getClient()->get('resources/'.$resource->getId().'/export', [
            'query' => [
                'locale' => $locale,
                'format' => $format,
                'options' => $options,
            ],
        ]);

        return $response->getBody();
    }
}
