<?php

require __DIR__.'/vendor/autoload.php';

use Openl10n\Api\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Guzzle\Http\Exception\ServerErrorResponseException;

$client = new Client(array(
    'hostname' => 'openl10n.local',
    'login'    => 'user',
    'password' => 'user',
));

try {

    $command = $client->getCommand('ListProjects');
    $projects = $client->execute($command);

    echo sprintf('%d projects found:', count($projects)).PHP_EOL;
    foreach ($projects as $project) {
        echo '  - '.$project['name'].PHP_EOL;
    }
    echo PHP_EOL;


    echo 'Creating new project...'.PHP_EOL;
    $command = $client->getCommand('CreateProject', array(
        'slug' => 'new-project',
        'name' => 'New Project',
        'defaultLocale' => 'en',
    ));
    $client->execute($command);


    $command = $client->getCommand('ListProjects');
    $projects = $client->execute($command);
    echo sprintf('%d projects found:', count($projects)).PHP_EOL;
    foreach ($projects as $project) {
        echo '  - '.$project['name'].PHP_EOL;
    }
    echo PHP_EOL;


    echo 'Deleting project...'.PHP_EOL;
    $command = $client->getCommand('DeleteProject', array(
        'project' => 'new-project',
    ));
    $client->execute($command);


    $command = $client->getCommand('ListProjects');
    $projects = $client->execute($command);
    echo sprintf('%d projects found:', count($projects)).PHP_EOL;
    foreach ($projects as $project) {
        echo '  - '.$project['name'].PHP_EOL;
    }
    echo PHP_EOL;


    echo 'Importing domain...'.PHP_EOL;
    $command = $client->getCommand('ImportDomain', array(
        'project' => 'tutorial',
        'slug' => 'messages',
        'locale' => 'en',
        'file' => '@/Users/m.moquet/Desktop/messages.en_GB.yml'
    ));
    $client->execute($command);


} catch (ClientErrorResponseException $e) {
    echo $e->getResponse().PHP_EOL;
} catch (ServerErrorResponseException $e) {
    echo $e->getResponse().PHP_EOL;
}
