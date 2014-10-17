<?php

namespace Openl10n\Sdk\Response;

use GuzzleHttp\Message\ResponseInterface;
use GuzzleHttp\Ring\Future\FutureInterface;
use GuzzleHttp\Ring\Future\MagicFutureTrait;
use React\Promise\Deferred;

class FutureEntity implements FutureInterface, \ArrayAccess
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

    public function offsetExists($offset)
    {
        return isset($this->_value[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->_value[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->_value[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->_value[$offset]);
    }
}
