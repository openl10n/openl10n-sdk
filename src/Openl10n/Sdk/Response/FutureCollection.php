<?php

namespace Openl10n\Sdk\Response;

use GuzzleHttp\Message\ResponseInterface;
use GuzzleHttp\Ring\Future\FutureInterface;
use GuzzleHttp\Ring\Future\MagicFutureTrait;
use React\Promise\Deferred;

class FutureCollection implements FutureInterface, \Countable, \IteratorAggregate
{
    use MagicFutureTrait;

    public static function createFromResponse(ResponseInterface $response)
    {
        $deferred = new Deferred();
        $promise = $deferred->promise();

        $onFulfilled = function($response) use ($deferred) {
            return $deferred->resolve($response->json());
        };

        $onRejected = function($exception) use ($deferred) {
            return $deferred->reject();
        };

        $response->then($onFulfilled, $onRejected);

        return new static($promise, [$response, 'wait']);
    }

    public function count()
    {
        return count($this->_value);
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->_value);
    }
}
