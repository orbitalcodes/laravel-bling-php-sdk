<?php

namespace Bling\Exceptions;

use Exception;
use Throwable;
use Psr\Http\Message\ResponseInterface;

class BlingResponseException extends Exception
{
    public function __construct(ResponseInterface $response, $content)
    {
        $erros = $content['retorno']['erros'] ?? [];
        $erro = [];

        if ($erros) {
            $erro = $erros['erro'] ?? [];
            if (!$erro && !isset($erro['msg'])) {
                $erro = array_first($erros)['erro'] ?? [];

                if (!$erro) {
                    $erro['cod'] = array_keys($erros)[0] ?? null;
                    $erro['msg'] = $erros[$erro['cod']] ?? null;

                    if (!is_string($erro['msg'])) {
                        $erro = $erros[0][0]['erro'] ?? [];
                    }
                }
            }
        }

        if (!$erro) {
            parent::__construct(json_encode($content), $response->getStatusCode(), $this);
        } else {
            parent::__construct($erro['msg'], $erro['cod'], $this);
        }
    }
}
