<?php

namespace Bling\Helpers;

use Bling\Contracts\BodyInterface;
use Spatie\ArrayToXml\ArrayToXml;

class XMLBody implements BodyInterface
{
    protected $root;

    public function __construct(string $root = null)
    {
        $this->root = $root;
    }

    public function setBody(array $body): string
    {
        return ArrayToXml::convert($body);
    }
}
