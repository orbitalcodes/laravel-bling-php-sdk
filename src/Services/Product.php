<?php

namespace Bling\Services;

use Bling\Exceptions\BlingResponseException;
use Bling\Helpers\XMLBody;
use Bling\Helpers\Body;
use Bling\Traits\CodeTrait;
use Bling\Traits\PageTrait;
use Bling\Traits\ProviderTrait;

class Product extends Base
{
    use PageTrait, ProviderTrait, CodeTrait;

    private $code = '';
    private $provider = '';
    private $page = 1;

    public function withImages(): self
    {
        $this->setParameters(['imagem' => 'S']);
        return $this;
    }

    public function withEstoque(): self
    {
        $this->setParameters(['estoque' => 'S']);
        return $this;
    }

    /**
     * @param array $body
     */
    public function setBody(array $body): self
    {
        $this->body = ['xml' => (new Body(new XMLBody('produto')))->setBody($body)];
        return $this;
    }

    public function all()
    {
        return $this->connect
            ->execute(
                'get',
                $this->getMergedParameters(),
                "produtos{$this->getPage()}{$this->getResponseType()}"
            );
    }

    public function get(): array
    {
        return $this->connect
            ->execute(
                'get',
                $this->getMergedParameters(),
                "produto{$this->getCode()}{$this->getProvider()}{$this->getResponseType()}"
            )->pluck('produto')->first();
    }

    public function exists(): bool
    {
        try {
            return $this->connect
                ->execute(
                    'get',
                    $this->getMergedParameters(),
                    "produto{$this->getCode()}{$this->getProvider()}{$this->getResponseType()}"
                )->pluck('produto')->filter()->count() > 0;

        } catch (BlingResponseException $exception) {
            return false;
        }
    }

    public function store()
    {
        return $this->connect
            ->execute('post', $this->getMergedParameters(), "produto{$this->getResponseType()}/")
            ->pluck('produto')
            ->first();
    }

    public function update(): array
    {
        return $this->connect
            ->execute(
                'post',
                $this->getMergedParameters(),
                "produto{$this->getCode()}{$this->getResponseType()}/"
            )
            ->pluck('produto')
            ->first();
    }

    public function destroy()
    {
        return $this->connect
            ->execute('delete', $this->getMergedParameters(), "produtos{$this->getCode()}");
    }
}
