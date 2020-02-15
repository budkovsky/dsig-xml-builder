<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\SimpleAdapter;

use Budkovsky\DsigXmlBuilder\Abstraction\SimpleAdapterAbstract;
use Budkovsky\DsigXmlBuilder\Enum\Tag;

/**
 * Xpath simple content entity's adapter
 */
class XpathAdapter extends SimpleAdapterAbstract
{

    /**
     * {@inheritDoc}
     */
    protected function getTagName(): string
    {
        return Tag::XPATH_ELEMENT;
    }
}
