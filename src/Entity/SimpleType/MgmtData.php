<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Entity\SimpleType;

use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\SimpleContentInterface;
use Budkovsky\DsigXmlBuilder\Partial\EntityAdapterTrait;
use Budkovsky\DsigXmlBuilder\Partial\SimpleContentTrait;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\SimpleAdapter\MgmtDataAdapter;

/**
 * MgmtData simpleContent entity
 */
class MgmtData implements DSigTypeInterface, SimpleContentInterface
{
    use EntityAdapterTrait;
    use SimpleContentTrait;

    /**
     * Returns default adapter for MgmtData entity
     *
     * @return MgmtDataAdapter
     */
    protected function getDefaultAdapter(): AdapterInterface
    {
        return new MgmtDataAdapter();
    }
}
