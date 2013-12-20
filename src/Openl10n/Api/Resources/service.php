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
                    'required' => true
                ),
            )
        ),
        'EditProject' => array(
            'httpMethod' => 'PUT',
            'uri'        => 'projects/{project}',
            'parameters' => array(
                'project' => array(
                    'location' => 'uri',
                    'type'     => 'string',
                    'required' => true
                ),
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
                    'required' => true
                ),
            )
        ),
        'DeleteProject' => array(
            'httpMethod' => 'DELETE',
            'uri'        => 'projects/{project}',
            'parameters' => array(
                'project' => array(
                    'location' => 'uri',
                    'type'     => 'string',
                    'required' => true
                ),
            )
        ),

        //
        // Translations import
        //
        'ImportDomain' => array(
            'httpMethod' => 'POST',
            'uri'        => 'projects/{project}/domains',
            'enctype'    => 'multipart/form-data',
            'parameters' => array(
                'project' => array(
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
    )
);
