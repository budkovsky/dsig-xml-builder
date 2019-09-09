<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Abstraction;

use Budkovsky\ExtendedDomElement\ExtendedDomElement;

interface ExtendedDOMElementGetter
{
    function getExtendedDOMDocument(): ExtendedDomElement;
}

