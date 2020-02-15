<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\SimpleAdapter;

use Budkovsky\DsigXmlBuilder\Abstraction\SimpleAdapterAbstract;
use Budkovsky\DsigXmlBuilder\Enum\Tag;

/**
 * X509SubjectName simple content entity's adapter
 */
class X509SubjectNameAdapter extends SimpleAdapterAbstract
{

/**
     * {@inheritDoc}
     */
    protected function getTagName(): string
    {
        return Tag::X509_SUBJECT_NAME_ELEMENT;
    }
}
