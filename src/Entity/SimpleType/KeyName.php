<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Entity\SimpleType;

use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\SimpleContentInterface;
use Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\SimpleAdapter\KeyNameAdapter;
use Budkovsky\DsigXmlBuilder\Partial\EntityAdapterTrait;
use Budkovsky\DsigXmlBuilder\Partial\SimpleContentTrait;

/**
 * KeyName simpleContent entity
 */
class KeyName implements DSigTypeInterface, SimpleContentInterface
{
    use EntityAdapterTrait;
    use SimpleContentTrait;

    /**
     * Returns default adapter for KeyName entity
     *
     * @return KeyNameAdapter
     */
    protected function getDefaultAdapter(): AdapterInterface
    {
        return new KeyNameAdapter();
    }
}
