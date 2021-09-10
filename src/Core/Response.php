<?php

namespace Bling\Core;

use Bling\Exceptions\ResponseException;
use Illuminate\Support\Collection;
use Psr\Http\Message\ResponseInterface;

class Response
{
    /**
     * Read the PSR response after the api request is made
     * @param ResponseInterface $response
     * @return string
     * @throws \Exception
     */
    public function getResponseContents(ResponseInterface $response): string
    {
         if ($response->getStatusCode() != 200 && $response->getStatusCode() != 201) {
             throw new ResponseException($response);
         }

        return $this->prepareResponse($response->getBody()->getContents());
    }

    protected function prepareResponse(string $response): Collection
    {
        $data = json_decode($response, true);
        return new Collection($data);
    }
}
