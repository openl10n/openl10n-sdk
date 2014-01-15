<?php

require __DIR__.'/vendor/autoload.php';

use Openl10n\Sdk\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Guzzle\Http\Exception\ServerErrorResponseException;

$serverHost = 'openl10n.dev';
$serverLogin = 'user';
$serverPassword = 'user';

$projectSlug = 'silex';

$client = new Client(array(
    'hostname' => $serverHost,
    'login'    => $serverLogin,
    'password' => $serverPassword,
));

try {

    try {
        echo 'Fetching project...'.PHP_EOL;
        $command = $client->getCommand('GetProject', array(
            'slug' => $projectSlug,
        ));
        $client->execute($command);
    } catch (ClientErrorResponseException $e) {
        if (404 != $e->getResponse()->getStatusCode()) {
            throw $e;
        }

        echo 'Creating new project...'.PHP_EOL;
        $command = $client->getCommand('CreateProject', array(
            'slug' => $projectSlug,
            'name' => ucfirst($projectSlug),
        ));
        $client->execute($command);
    }

    echo 'Importing domain...'.PHP_EOL;
    $command = $client->getCommand('ImportDomain', array(
        'project' => $projectSlug,
        'slug' => 'messages',
        'locale' => 'en',
        'file' => '@/Users/m.moquet/Projects/openl10n-demos/demo-silex/resources/locales/messages.en.yml'
    ));
    $client->execute($command);

    exit;

    echo 'Exporting domain...'.PHP_EOL;
    $command = $client->getCommand('ExportDomain', array(
        'project' => 'silex',
        'domain' => 'messages',
        'locale' => 'en',
        'format' => 'xlf',
    ));
    $response = $client->execute($command);

    echo get_class($response).PHP_EOL;
    echo (string) $response;
    //var_dump($response);

    exit;


} catch (ClientErrorResponseException $e) {
    echo $e->getResponse().PHP_EOL;
} catch (ServerErrorResponseException $e) {
    echo $e->getResponse().PHP_EOL;
}
