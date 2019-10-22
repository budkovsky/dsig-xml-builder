<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\SimpleAdapter;

use Budkovsky\DsigXmlBuilder\Abstraction\SimpleAdapterAbstract;
use Budkovsky\DsigXmlBuilder\Enum\Tag;

class MgmtDataAdapter extends SimpleAdapterAbstract
{

    protected function getTagName(): string
    {
        return Tag::MGMT_DATA_ELEMENT;
    }
}
