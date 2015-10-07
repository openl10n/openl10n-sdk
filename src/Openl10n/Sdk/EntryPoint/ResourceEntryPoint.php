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

    public function findByProject(Project $project)
    {
        $results = json_decode(
            $this->getClient()->get(
                'resources',
                [
                    'query' => ['project' => $project->getSlug()]
                ]
            )->getBody(),
            true
        );

        $resources = array();
        foreach ($results as $result) {
            $resource = new Resource($result['project']);
            $resource->setId($result['id']);
            $resource->setPathname($result['pathname']);

            $resources[] = $resource;
        }

        return $resources;
    }

    public function get($id)
    {
        $result = json_decode($this->getClient()->get('resource/'.$id)->getBody(), true);

        $resource = new Resource($result['project']);
        $resource->setId($result['id']);
        $resource->setPathname($result['pathname']);

        return $resource;
    }

    public function create(Resource $resource)
    {
        $response = json_decode(
            $this->getClient()->post(
                'resources',
                [
                    'headers' => [
                        'Content-Type' => 'application/json'
                    ],
                    'body' => json_encode([
                        'project' => $resource->getProjectSlug(),
                        'pathname' => $resource->getPathname(),
                    ]),
                ]
            )->getBody(),
            true
        );

        $resource->setId($response['id']);
    }

    public function update(Resource $resource)
    {
        $this->getClient()->post('resources/'.$resource->getId(), [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode([
                'pathname' => $resource->getPathname(),
            ]),
        ]);
    }

    public function delete(Resource $resource)
    {
        $this->getClient()->delete('resources/'.$resource->getId());
    }

    public function import(Resource $resource, $filepath, $locale, array $options = array())
    {
        $this->getClient()->post('resources/'.$resource->getId().'/import', [
            'body' => [
                'locale' => $locale,
                'file' => fopen($filepath, 'r'),
                'options' => $options,
            ],
        ]);
    }

    public function export(Resource $resource, $locale, array $options = array(), $format = null)
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
