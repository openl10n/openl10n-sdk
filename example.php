<?php

require __DIR__.'/vendor/autoload.php';

use GuzzleHttp\Exception\RequestException;
use Openl10n\Sdk\Api;
use Openl10n\Sdk\Config;
use Openl10n\Sdk\Model\Project;
use Openl10n\Sdk\Model\Resource;

try {
	$api = new Api((new Config('openl10n.dev'))->setAuth('user', 'user'));
	$projectApi = $api->getEntryPoint('project');
	$resourceApi = $api->getEntryPoint('resource');

	$demo = $projectApi->get('demo');

	//$projectApi->addLanguage($demo, 'pt_BR');
	//$projectApi->deleteLanguage($demo, 'pt_BR');
	$languages = $projectApi->getLanguages($demo);

	// echo 'Available languages:'.PHP_EOL;
	// array_walk($languages, function($language) {
	// 	echo '  - '.$language.PHP_EOL;
	// });

	$resources = $resourceApi->findByProject($demo);
	//var_dump($resources);
	//die;

	// $resource = new Resource($demo->getSlug());
	// $resource->setPathname('path/to/en/my.yml');
	// $resourceApi->create($resource);
	$resource = new Resource($demo->getSlug());
	$resource->setId(2);

	//$resourceApi->import($resource, '/Users/m.moquet/Desktop/foobar.en.yml', 'en');
	$content = $resourceApi->export($resource, 'en', [], 'po');

	echo $content.PHP_EOL;



	exit;
	$projects = $projectApi->findAll();

	var_dump($projects);

	$demo = $projects[0];
	$demo->setName('Demo');
	$projectApi->update($demo);

	$new = new Project('example');
	$new->setName('Example');
	$new->setDefaultLocale('en_US');
	$projectApi->create($new);

	$projectApi->delete($new);

} catch (RequestException $e) {
    echo $e->getRequest();
    if ($e->hasResponse()) {
        echo $e->getResponse();
    }
}


return;

$client = $api->getClient();
$res = $client->get('projects');
var_export($res->json());

return;

$api = new Api($options, $logger);

$projectRepository = $api->getEntryPoint('project');
$projectRepository->findAll();
$projectRepository->get('foobar');
$projectRepository->create($project);
$projectRepository->update($project);
$projectRepository->delete($project);
$projectRepository->addLanguage($project, $locale);
$projectRepository->removeLanguage($project, $locale);

$resourceRepository = $api->getEntryPoint('resource');
$resourceRepository->findByProject('demo');
$resourceRepository->get(1);
$resourceRepository->create($resource);
$resourceRepository->update($resource);
$resourceRepository->delete($resource);
$resourceRepository->import($resource, $locale, $file, $options);
$resourceRepository->export($resource, $locale, $format, $options);

$translationRepository = $api->getEntryPoint('translation');
$translationRepository->findBy('???');
$translationRepository->get(1);
$translationRepository->create($translation);
$translationRepository->update($translation);
$translationRepository->delete($translation);
