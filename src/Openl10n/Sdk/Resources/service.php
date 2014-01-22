<?php

return array(
    'name'        => 'Openl10n',
    'apiVersion'  => 'v1',
    'description' => 'OpenLocalization',
    'operations'  => array(
        //
        // Projects CRUD
        //
        'ListProjects' => array(
            'httpMethod' => 'GET',
            'uri'        => 'projects',
        ),
        'CreateProject' => array(
            'httpMethod' => 'POST',
            'uri'        => 'projects',
            'parameters' => array(
                'name' => array(
                    'location' => 'json',
                    'type'     => 'string',
                    'required' => true
                ),
                'slug' => array(
                    'location' => 'json',
                    'type'     => 'string',
                    'required' => true
                ),
                'defaultLocale' => array(
                    'location' => 'json',
                    'type'     => 'string',
                    'default'  => 'en',
                    'required' => true,
                ),
            )
        ),
        'GetProject' => array(
            'httpMethod' => 'GET',
            'uri'        => 'projects/{projectSlug}',
            'responseClass' => 'Openl10n\Sdk\Model\Project',
            'parameters' => array(
                'projectSlug' => array(
                    'location' => 'uri',
                    'type'     => 'string',
                    'required' => true
                ),
            )
        ),
        'EditProject' => array(
            'httpMethod' => 'PUT',
            'uri'        => 'projects/{projectSlug}',
            'parameters' => array(
                'projectSlug' => array(
                    'location' => 'uri',
                    'type'     => 'string',
                    'required' => true
                ),
                'name' => array(
                    'location' => 'json',
                    'type'     => 'string',
                    'required' => true
                ),
                'defaultLocale' => array(
                    'location' => 'json',
                    'type'     => 'string',
                    'required' => true
                ),
            )
        ),
        'DeleteProject' => array(
            'httpMethod' => 'DELETE',
            'uri'        => 'projects/{projectSlug}',
            'parameters' => array(
                'projectSlug' => array(
                    'location' => 'uri',
                    'type'     => 'string',
                    'required' => true
                ),
            )
        ),

        //
        // Languages CRUD
        //
        'ListLanguages' => array(
            'httpMethod' => 'GET',
            'uri'        => 'projects/{projectSlug}/languages',
            'parameters' => array(
                'projectSlug' => array(
                    'location' => 'uri',
                    'type'     => 'string',
                    'required' => true
                ),
            )
        ),
        'CreateLanguage' => array(
            'httpMethod' => 'POST',
            'uri'        => 'projects/{projectSlug}/languages',
            'parameters' => array(
                'projectSlug' => array(
                    'location' => 'uri',
                    'type'     => 'string',
                    'required' => true
                ),
                'locale' => array(
                    'location' => 'json',
                    'type'     => 'string',
                    'required' => true,
                ),
            )
        ),
        'GetLanguage' => array(
            'httpMethod' => 'GET',
            'uri'        => 'projects/{projectSlug}/languages/{locale}',
            'parameters' => array(
                'projectSlug' => array(
                    'location' => 'uri',
                    'type'     => 'string',
                    'required' => true
                ),
                'locale' => array(
                    'location' => 'uri',
                    'type'     => 'string',
                    'required' => true,
                ),
            )
        ),
        'DeleteLanguage' => array(
            'httpMethod' => 'DELETE',
            'uri'        => 'projects/{projectSlug}/languages/{locale}',
            'parameters' => array(
                'projectSlug' => array(
                    'location' => 'uri',
                    'type'     => 'string',
                    'required' => true
                ),
                'locale' => array(
                    'location' => 'uri',
                    'type'     => 'string',
                    'required' => true,
                ),
            )
        ),

        //
        // Translations import/export
        //
        'ImportDomain' => array(
            'httpMethod' => 'POST',
            'uri'        => 'projects/{projectSlug}/domains',
            'enctype'    => 'multipart/form-data',
            'parameters' => array(
                'projectSlug' => array(
                    'location' => 'uri',
                    'type'     => 'string',
                    'required' => true
                ),
                'slug' => array(
                    'location' => 'postField',
                    'type'     => 'string',
                    'required' => true
                ),
                'locale' => array(
                    'location' => 'postField',
                    'type'     => 'string',
                    'required' => true
                ),
                'file' => array(
                    'location' => 'postFile',
                    'type'     => 'string',
                    'required' => true
                ),
            )
        ),
        'ExportDomain' => array(
            'httpMethod' => 'GET',
            'uri'        => 'projects/{project}/domains/{domain}/translations.{locale}.{format}',
            'responseClass' => 'string',
            'parameters' => array(
                'project' => array(
                    'location' => 'uri',
                    'type'     => 'string',
                    'required' => true
                ),
                'domain' => array(
                    'location' => 'uri',
                    'type'     => 'string',
                    'required' => true
                ),
                'locale' => array(
                    'location' => 'uri',
                    'type'     => 'string',
                    'required' => true
                ),
                'format' => array(
                    'location' => 'uri',
                    'type'     => 'string',
                    'required' => true
                ),
            )
        ),
    )
);
