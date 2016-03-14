<?php

namespace Openl10n\Sdk\EntryPoint;

use Openl10n\Sdk\Model\Project;
use Openl10n\Sdk\Model\Translation;

class TranslationEntryPoint extends AbstractEntryPoint
{
    public function getName()
    {
        return 'translation';
    }

    public function findBy()
    {
        throw new \BadMethodCallException('Not implemented yet!');
    }

    /**
     * Finds a Translation by its identifier
     *
     * @param Project $project
     * @param string  $identifier
     *
     * @return Translation
     */
    public function findOneByIdentifier(Project $project, $identifier)
    {
        $results = json_decode(
            $this->getClient()->get(
                'translations',
                [
                    'query' => [
                        'project'    => $project->getSlug(),
                        'identifier' => $identifier
                    ]
                ]
            )->getBody(),
            true
        );

        if (count($results) === 1) {
            $translation = new Translation($results[0]['identifier'], $results[0]['resource_id']);
            $translation->setId($results[0]['id']);

            return $translation;
        }

        return null;
    }

    public function get($id)
    {
        throw new \BadMethodCallException('Not implemented yet!');
    }

    public function create(Translation $translation)
    {
        $response = $this->getClient()->post('translations', [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode([
                'identifier' => $translation->getIdentifier(),
                'resource'   => $translation->getResourceId(),
            ]),
        ])->json();

        $translation->setId($response['id']);

        return $translation;
    }

    public function update(Translation $translation)
    {
        throw new \BadMethodCallException('Not implemented yet!');
    }

    public function delete(Translation $translation)
    {
        $this->getClient()->delete('translations/' . $translation->getId());
    }
}
