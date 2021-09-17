<?php

namespace Bling\Traits;

trait StoreIdTrait
{
    protected $storeId;

    /**
     * @return string
     */
    public function getStoreId(): string
    {
        return ($this->storeId ? '/' : '') . ltrim($this->storeId, '/');
    }

    /**
     * @param int $storeId
     */
    public function setStoreId(int $storeId): self
    {
        $this->storeId = $storeId;
        return $this;
    }
}
