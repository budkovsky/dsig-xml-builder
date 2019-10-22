<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Entity\SimpleType;

use Budkovsky\DsigXmlBuilder\Partial\SimpleContentTrait;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\SimpleContentInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Partial\EntityAdapterTrait;
use Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\SimpleAdapter\X509SubjectNameAdapter;

class X509SubjectName implements DSigTypeInterface, SimpleContentInterface
{
    use EntityAdapterTrait;
    use SimpleContentTrait;

    protected function getDefaultAdapter(): AdapterInterface
    {
        return new X509SubjectNameAdapter();
    }
}
