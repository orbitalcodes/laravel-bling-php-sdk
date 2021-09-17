<?php

namespace Bling\Services;

use Bling\Exceptions\BlingResponseException;
use Bling\Helpers\XMLBody;
use Bling\Helpers\Body;
use Bling\Traits\CodeTrait;
use Bling\Traits\PageTrait;
use Bling\Traits\ProviderTrait;
use Bling\Traits\StoreIdTrait;

class StoreProduct extends Base
{
    use PageTrait, ProviderTrait, CodeTrait, StoreIdTrait;

    private $code = '';
    private $provider = '';
    private $page = 1;

    /**
     * @param array $body
     */
    public function setBody(array $body): self
    {
        $this->body = ['xml' => (new Body(new XMLBody('produtosLoja')))->setBody($body)];
        return $this;
    }

    public function get(): array
    {
        return $this->connect
            ->execute(
                'get',
                $this->getMergedParameters(),
                "produtoLoja{$this->getCode()}{$this->getResponseType()}"
            )->pluck('produto')->first();
    }

    public function exists(): bool
    {
        try {
            $this->connect
                ->execute(
                    'get',
                    $this->getMergedParameters(),
                    "produtoLoja{$this->getCode()}{$this->getResponseType()}"
                )->pluck('produtoLoja')->first();

            return true;

        } catch (BlingResponseException $exception) {
            return false;
        }
    }

    public function store()
    {
        return $this->connect
            ->execute('post', $this->getMergedParameters(), "produtoLoja{$this->getStoreId()}{$this->getCode()}{$this->getResponseType()}/");
    }

    public function update(): array
    {
        return $this->connect
            ->execute(
                'put',
                $this->getMergedParameters(),
                "produtoLoja{$this->getStoreId()}{$this->getCode()}{$this->getResponseType()}/"
            )->first()[0]['produtoLoja'];
    }
}
