<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\SimpleAdapter;

use Budkovsky\DsigXmlBuilder\Abstraction\SimpleAdapterAbstract;
use Budkovsky\DsigXmlBuilder\Enum\Tag;

/**
 * SPKISexp simple content entity's adapter
 */
class SPKISexpAdapter extends SimpleAdapterAbstract
{
    /**
     * {@inheritDoc}
     */
    protected function getTagName(): string
    {
        return Tag::SPKI_SEXP_ELEMENT;
    }
}
