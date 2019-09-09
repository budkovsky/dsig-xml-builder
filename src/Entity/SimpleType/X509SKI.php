<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Entity\SimpleType;

use Budkovsky\DsigXmlBuilder\Abstraction\SimpleContentInterface;
use Budkovsky\DsigXmlBuilder\Partial\SimpleContentTrait;

class X509SKI implements SimpleContentInterface
{
    use SimpleContentTrait;
}
