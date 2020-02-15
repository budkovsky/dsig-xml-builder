<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Adapter\DOMDocument;

use Budkovsky\DsigXmlBuilder\Abstraction\AdapterAbstract;
use Budkovsky\DsigXmlBuilder\Entity\RetrievalMethodType;
use Budkovsky\DsigXmlBuilder\Enum\Tag;
use Budkovsky\DsigXmlBuilder\Enum\Attribute;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Partial\AdapterTransformsTrait;

/**
 * RetrievalMethod adapter
 */
class RetrievalMethodAdapter extends AdapterAbstract
{
    use AdapterTransformsTrait;

    /**
     * {@inheritDoc}
     */
    public function generate(): AdapterInterface
    {
        $this->generateMainElement(Tag::RETRIEVAL_METHOD_ELEMENT);
        if ($this->getEntity()->getUriAttribute() !== null) {
            $this->generateAttribute(Attribute::URI, $this->getEntity()->getUriAttribute());
        }
        if ($this->getEntity()->getTypeAttribute() !== null) {
            $this->generateAttribute(Attribute::TYPE, $this->getEntity()->getTypeAttribute());
        }
        if ($this->getEntity()->getTransforms() !== null && $this->getEntity()->getTransforms()->count() > 0) {
            $this->element->appendChild(
                $this->getTransformsElement(
                    $this->getEntity()->getTransforms()
                )
            );
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    protected function getEntity(): RetrievalMethodType
    {
        return $this->entity;
    }

    /**
     * {@inheritDoc}
     */
    protected function setEntityType(): void
    {
        $this->entityType = RetrievalMethodType::class;
    }
}
