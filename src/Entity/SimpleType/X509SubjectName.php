<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Entity\SimpleType;

use Budkovsky\DsigXmlBuilder\Partial\SimpleContentTrait;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\SimpleContentInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Partial\EntityAdapterTrait;
use Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\SimpleAdapter\X509SubjectNameAdapter;

/**
 * X509SubjectName simpleContent entity
 */
class X509SubjectName implements DSigTypeInterface, SimpleContentInterface
{
    use EntityAdapterTrait;
    use SimpleContentTrait;

    /**
     * Return default adapter for X509SubjectName entity
     * @return X509SubjectNameAdapter
     */
    protected function getDefaultAdapter(): AdapterInterface
    {
        return new X509SubjectNameAdapter();
    }
}
