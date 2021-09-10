<?php

namespace Bling\Exceptions;

use Exception;
use Throwable;
use Psr\Http\Message\ResponseInterface;

class ResponseException extends Exception
{
    public function __construct(ResponseInterface $response)
    {
        $data = json_decode($response->getBody()->getContents(), true);

        parent::__construct('wawa', $response->getStatusCode(), null);
    }
}