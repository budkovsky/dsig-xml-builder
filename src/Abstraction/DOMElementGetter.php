<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Abstraction;

/**
 * Interface for type with DOMElement getter
 */
interface DOMElementGetter
{
    /**
     * Returns DOMElement
     * @return \DOMElement|NULL
     */
    public function getDOMElement(): \DOMElement;
}
