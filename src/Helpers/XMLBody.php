<?php

namespace Bling\Helpers;

use Bling\Contracts\BodyInterface;

class XMLBody implements BodyInterface
{
    protected $root;

    public function __construct(string $root = null)
    {
        $this->root = $root;
    }

    public function toXml($array, $rootElement = null, $xml = null)
    {
        $_xml = $xml;

        if ($_xml === null) {
            $_xml = new \SimpleXMLElement($rootElement !== null ? "<{$rootElement}/>" : '<root/>');
        }

        foreach ($array as $k => $v) {
            if (is_array($v)) {
                if(is_int($k)) {
                    $this->toXml($v, $rootElement, $_xml->addChild($rootElement));
                } else {
                    $this->toXml($v, $k, $_xml->addChild($k));
                }
            } else {
                $_xml->addChild($k, $v);
            }
        }

        return $_xml->asXML();
    }

    public function setBody(array $body): string
    {
        $xml = new \SimpleXMLElement('<root/>');
        array_walk_recursive($body, array ($xml, 'addChild'));

        return $xml->asXML();
    }
}
