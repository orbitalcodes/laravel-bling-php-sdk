<?php

namespace Bling\Services;

use Bling\Helpers\XMLBody;
use Bling\Helpers\Body;

class Category extends Base
{
    private $id = '';

    /**
     * @return string
     */
    public function getId(): string
    {
        return ($this->id ? '/' : '') . ltrim($this->id, '/');
    }

    /**
     * @param string $id
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param array $body
     */
    public function setBody(array $body): self
    {
        $this->body = ['xml' => (new Body(new XMLBody('categorias')))->setBody(['categoria' => $body])];
        return $this;
    }

    public function all()
    {
        return $this->connect
            ->execute('get', $this->getMergedParameters(), "categorias{$this->getResponseType()}");
    }

    public function get()
    {
        return $this->connect
            ->execute('get', $this->getMergedParameters(), "categoria{$this->getId()}{$this->getResponseType()}");
    }

    public function store()
    {
        return $this->connect
            ->execute('post', $this->getMergedParameters(), "categoria{$this->getResponseType()}/");
    }

    public function update()
    {
        return $this->connect
            ->execute('put', $this->getMergedParameters(), "categoria{$this->getId()}{$this->getResponseType()}/");
    }
}
