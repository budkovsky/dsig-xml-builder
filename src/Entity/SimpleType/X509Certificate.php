<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Entity\SimpleType;

use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\SimpleContentInterface;
use Budkovsky\DsigXmlBuilder\Partial\SimpleContentTrait;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Partial\EntityAdapterTrait;
use Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\SimpleAdapter\X509CertificateAdapter;

/**
 * X509Certificate simpleContent entity
 */
class X509Certificate implements DSigTypeInterface, SimpleContentInterface
{
    use EntityAdapterTrait;
    use SimpleContentTrait;

    /**
     * Returns default adapter for X509Certificate entity
     * @return X509CertificateAdapter
     */
    protected function getDefaultAdapter(): AdapterInterface
    {
        return new X509CertificateAdapter();
    }
}
