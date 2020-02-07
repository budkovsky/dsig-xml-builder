<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Abstraction;

interface DOMDocumentGetter
{
    public function getDOMDocument(): ?\DOMDocument;
}
