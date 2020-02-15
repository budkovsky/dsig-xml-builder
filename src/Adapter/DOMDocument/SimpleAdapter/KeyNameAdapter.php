<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\SimpleAdapter;

use Budkovsky\DsigXmlBuilder\Abstraction\SimpleAdapterAbstract;
use Budkovsky\DsigXmlBuilder\Enum\Tag;

/**
 * KeyName simple content entity's adapter
 */
class KeyNameAdapter extends SimpleAdapterAbstract
{

    /**
     * {@inheritDoc}
     */
    protected function getTagName(): string
    {
        return Tag::KEY_NAME_ELEMENT;
    }
}
