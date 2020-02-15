<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Adapter\DOMDocument;

use Budkovsky\DsigXmlBuilder\Abstraction\AdapterAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Entity\SPKIDataType;
use Budkovsky\DsigXmlBuilder\Enum\Tag;
use Budkovsky\DsigXmlBuilder\Partial\AdapterChildrenTrait;

/**
 * SPKIData adapter
 */
class SPKIDataAdapter extends AdapterAbstract
{
    use AdapterChildrenTrait;

    /**
     * {@inheritDoc}
     */
    public function generate(): AdapterInterface
    {
        $this->generateMainElement(Tag::SPKI_DATA_ELEMENT);
        $this->generateChildren();

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    protected function getEntity(): SPKIDataType
    {
        return $this->entity;
    }

    /**
     * {@inheritDoc}
     */
    protected function setEntityType(): void
    {
        $this->entityType = SPKIDataType::class;
    }
}
