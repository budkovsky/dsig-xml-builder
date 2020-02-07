<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Abstraction;

interface DOMElementGetter
{
    public function getDOMElement(): \DOMElement;
}
