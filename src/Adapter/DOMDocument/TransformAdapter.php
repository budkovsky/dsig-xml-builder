<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Adapter\DOMDocument;

use Budkovsky\DsigXmlBuilder\Abstraction\AdapterAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Entity\TransformType;
use Budkovsky\DsigXmlBuilder\Enum\Attribute;
use Budkovsky\DsigXmlBuilder\Enum\Tag;
use Budkovsky\DsigXmlBuilder\Partial\AdapterChildrenTrait;

/**
 * Transform adapter
 */
class TransformAdapter extends AdapterAbstract
{
    use AdapterChildrenTrait;

    /**
     * {@inheritDoc}
     */
    public function generate(): AdapterInterface
    {
        $this->generateMainElement(Tag::TRANSFORM_ELEMENT);
        $this->generateAttribute(Attribute::ALGORITHM, $this->getEntity()->getAlgorithmAttribute());
        $this->generateChildren();

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    protected function getEntity(): TransformType
    {
        return $this->entity;
    }

    /**
     * {@inheritDoc}
     */
    protected function setEntityType(): void
    {
        $this->entityType = TransformType::class;
    }
}
