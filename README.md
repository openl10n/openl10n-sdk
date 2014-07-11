# Openl10n SDK

## Usage

```php
<?php

require __DIR__.'/vendor/autoload.php';

use Openl10n\Sdk\Api;
use Openl10n\Sdk\Config;
use Openl10n\Sdk\Model\Resource;

$rootApi = new Api((new Config('openl10n.dev'))->setAuth('user', 'user'));

// Get API entry points
$projectApi = $rootApi->getEntryPoint('project');
$resourceApi = $rootApi->getEntryPoint('resource');

// Get project by its slug
$demo = $projectApi->get('demo');

// Create new resource file
$resource = new Resource($demo->getSlug());
$resource->setPathname('path/to/messages.en.yml');
$resourceApi->create($resource);

// Import some translations
$resourceApi->import($resource, 'path/to/messages.en.yml', 'en');

// Export content
$content = $resourceApi->export($resource, 'fr');
file_put_contents('path/to/messages.fr.yml', $content);
```

## License

OpenLocalization SDK is released under the MIT License.
See the bundled LICENSE file for details.
