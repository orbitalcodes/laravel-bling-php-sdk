<?php

namespace Bling\Core;

use Bling\Exceptions\BlingResponseException;
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
    public function getResponseContents(ResponseInterface $response): Collection
    {
        $content = json_decode($response->getBody()->getContents(), true);

        if ($response->getStatusCode() != 200 && $response->getStatusCode() != 201) {
            throw new BlingResponseException($response, $content);
        }

        if (isset($content['retorno']['erros'])) {
            throw new BlingResponseException($response, $content);
        }

        return $this->prepareResponse($content);
    }

    protected function prepareResponse(array $content): Collection
    {
        return new Collection(array_first($content['retorno'] ?? []));
    }
}
