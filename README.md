# Openl10n SDK

## Usage

```php
<?php

require __DIR__.'/vendor/autoload.php';

$api = new \Openl10n\Sdk\Api(array(
    'hostname' => 'openl10n.dev',
    'username' => 'user',
    'password' => 'user',
));

// Retrieve project (object Openl10n\Sdk\Model\Project)
$project = $api->getProject('foobar');

// Get languages (array of locales)
$languages = $api->getLanguages($project->getSlug());

// Import transaltion file
$api->importFile(
    $project->getSlug(),
    new \SplFileInfo('/path/to/messages.en.yml'),
    'messages',
    'en'
);

// Get file in different locale
$content = $api->exportFile(
    $project->getSlug(),
    'messages',
    'fr',
    'yml'
);
file_put_contents('/path/to/messages.fr.yml', $content);
```

## License

OpenLocalization is released under the MIT License. See the bundled LICENSE
file for details.
