<?php

namespace Bling\Services;

use Bling\Helpers\XMLBody;
use Bling\Helpers\Body;

class Order extends Base
{
    private $numero = '';

    /**
     * @return string
     */
    public function getNumero(): string
    {
        return ($this->numero ? '/' : '') . ltrim($this->numero, '/');
    }

    /**
     * @param string $numero
     */
    public function setNumero(string $numero): self
    {
        $this->numero = $numero;
        return $this;

    }

    /**
     * @param array $body
     */
    public function setBody(array $body): self
    {
        $this->body = ['xml' => (new Body(new XMLBody('pedido')))->setBody($body)];
        return $this;
    }

    public function all()
    {
        return $this->connect
            ->execute('get', $this->getMergedParameters(), "pedidos{$this->getResponseType()}");
    }

    public function get()
    {
        return $this->connect
            ->execute('get', $this->getMergedParameters(), "pedido{$this->getNumero()}{$this->getResponseType()}");
    }

    public function store()
    {
        return $this->connect
            ->execute('post', $this->getMergedParameters(), "pedido{$this->getResponseType()}/")
            ->pluck('pedido')
            ->first();
    }

    public function update()
    {
        return $this->connect
            ->execute('put', $this->getMergedParameters(), "pedido{$this->getNumero()}{$this->getResponseType()}/")
            ->pluck('pedido')
            ->first();
    }
}
