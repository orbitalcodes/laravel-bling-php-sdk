<?php

namespace Bling\Traits;

trait ProviderTrait
{
    /**
     * @return string
     */
    public function getProvider(): string
    {
        return ($this->page ? '/' : '') . ltrim("page={$this->page}", '/');
    }

    /**
     * @param string $provider
     */
    public function setProvider(string $provider): self
    {
        $this->provider = $provider;
        return $this;
    }
}
