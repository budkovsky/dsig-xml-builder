<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\SimpleAdapter;

use Budkovsky\DsigXmlBuilder\Abstraction\SimpleAdapterAbstract;
use Budkovsky\DsigXmlBuilder\Enum\Tag;

/**
 * X509Certificate simple content entity's adapter
 */
class X509CertificateAdapter extends SimpleAdapterAbstract
{

    /**
     * {@inheritDoc}
     */
    protected function getTagName(): string
    {
        return Tag::X509_CERTIFICATE_ELEMENT;
    }
}
