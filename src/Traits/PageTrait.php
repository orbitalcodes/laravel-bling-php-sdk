<?php

namespace Bling\Traits;

trait PageTrait
{
    /**
     * @return int
     */
    public function getPage(): string
    {
        return ($this->page ? '/' : '') . ltrim("page={$this->page}", '/');
    }

    /**
     * @param int $page
     */
    public function setPage(int $page): self
    {
        $this->page = $page;
        return $this;
    }
}
