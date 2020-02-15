<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Adapter\DOMDocument;

use Budkovsky\DsigXmlBuilder\Abstraction\AdapterAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Entity\CanonicalizationMethodType;
use Budkovsky\DsigXmlBuilder\Enum\Attribute;
use Budkovsky\DsigXmlBuilder\Enum\Tag;
use Budkovsky\DsigXmlBuilder\Partial\AdapterChildrenTrait;

/**
 * CanonicalizationMethod entity adapter
 */
class CanonicalizationMethodAdapter extends AdapterAbstract
{
    use AdapterChildrenTrait;

    /**
     * {@inheritDoc}
     */
    public function generate(): AdapterInterface
    {
        $this->generateMainElement(Tag::CANONICALIZATION_METHOD_ELEMENT);
        $this->generateAttribute(Attribute::ALGORITHM, $this->getEntity()->getAlgorithmAttribute());
        $this->generateChildren();

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getEntity(): CanonicalizationMethodType
    {
        return $this->entity;
    }

    /**
     * {@inheritDoc}
     */
    protected function setEntityType(): void
    {
        $this->entityType = CanonicalizationMethodType::class;
    }
}
