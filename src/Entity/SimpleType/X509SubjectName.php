<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Entity\SimpleType;

use Budkovsky\DsigXmlBuilder\Partial\SimpleContentTrait;
use Budkovsky\DsigXmlBuilder\Abstraction\SimpleContentInterface;

class X509SubjectName implements SimpleContentInterface
{
    use SimpleContentTrait;
}
