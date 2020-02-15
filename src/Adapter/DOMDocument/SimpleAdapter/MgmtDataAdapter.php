<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\SimpleAdapter;

use Budkovsky\DsigXmlBuilder\Abstraction\SimpleAdapterAbstract;
use Budkovsky\DsigXmlBuilder\Enum\Tag;

/**
 * MgmtData simple content entity's adapter
 */
class MgmtDataAdapter extends SimpleAdapterAbstract
{

    /**
     * {@inheritDoc}
     */
    protected function getTagName(): string
    {
        return Tag::MGMT_DATA_ELEMENT;
    }
}
