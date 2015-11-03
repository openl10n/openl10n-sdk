# Openl10n SDK

[![License MIT](http://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/openl10n/openl10n-sdk/blob/master/LICENSE)
[![Packagist](http://img.shields.io/packagist/v/openl10n/openl10n.svg)](https://packagist.org/packages/openl10n/sdk)
[![Dependency Status](https://www.versioneye.com/user/projects/543ce51964e43a6bbb000029/badge.svg)](https://www.versioneye.com/user/projects/543ce51964e43a6bbb000029)

Openl10n SDK is a PHP client for [openl10n API](https://github.com/openl10n/openl10n).
It uses [Guzzle](http://guzzlephp.org/) library to handle HTTP requests.

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
See the [bundled LICENSE file](LICENSE) for details.
