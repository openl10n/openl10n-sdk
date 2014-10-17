<?php

namespace Openl10n\Sdk\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Message\MessageFactory;
use GuzzleHttp\Ring\Client\MockHandler;

class TestCase extends \PHPUnit_Framework_TestCase
{
    protected $client;

    public function setUp()
    {
        $this->client = new Client([
            'handler' => new MockHandler([$this, 'handleRequest'])
        ]);
    }

    /**
     * Callable used to mock request/response transfert.
     *
     * @param array $request The request to mock
     *
     * @return array The response
     */
    public function handleRequest($request)
    {
        $method = $request['http_method'];
        $path = $request['url'];

        // Append the body as a checksum to retrieve the right file
        if (null !== $request['body']) {
            $path .= '__'.md5($request['body']);
        }

        // TODO: Vary the extension according to accept header or format
        $path .= '.json';

        $filepath = __DIR__."/Fixtures/$method/$path";

        if (!file_exists($filepath)) {
            $errorCode = in_array($method, ['GET', 'DELETE']) ? 404 : 400;

            return ['status' => $errorCode];
        }

        $factory = new MessageFactory();
        $message = file_get_contents($filepath);
        $response = $factory->fromMessage($message);

        return [
            'status' => $response->getStatusCode(),
            'headers' => $response->getHeaders(),
            'body' => $response->getBody(),
        ];
    }
}
