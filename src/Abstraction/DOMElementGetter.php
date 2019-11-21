<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Abstraction;

interface DOMElementGetter
{
    function getDOMElement(): ?\DOMElement;
}

