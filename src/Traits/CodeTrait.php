<?php

namespace Bling\Traits;

trait CodeTrait
{
    /**
     * @return string
     */
    public function getCode(): string
    {
        return ($this->code ? '/' : '') . ltrim($this->code, '/');
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): self
    {
        $this->code = $code;
        return $this;
    }
}
