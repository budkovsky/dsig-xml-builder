<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Entity\SimpleType;

use Budkovsky\DsigXmlBuilder\Abstraction\SimpleContentInterface;
use Budkovsky\DsigXmlBuilder\Partial\SimpleContentTrait;

class SPKISexp implements SimpleContentInterface
{
    use SimpleContentTrait;
}