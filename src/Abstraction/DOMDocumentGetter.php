<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Abstraction;

/**
 * Interface for type with DOMDocument getter
 */
interface DOMDocumentGetter
{
    /**
     * Returns DOMDocument
     * @return \DOMDocument|NULL
     */
    public function getDOMDocument(): ?\DOMDocument;
}
