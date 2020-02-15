<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Adapter\DOMDocument;

use Budkovsky\DsigXmlBuilder\Abstraction\AdapterAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Entity\ObjectType;
use Budkovsky\DsigXmlBuilder\Enum\Attribute;
use Budkovsky\DsigXmlBuilder\Enum\Tag;
use Budkovsky\DsigXmlBuilder\Partial\AdapterChildrenTrait;

/**
 * Object adapter
 */
class ObjectAdapter extends AdapterAbstract
{
    use AdapterChildrenTrait;

    /**
     * {@inheritDoc}
     */
    public function generate(): AdapterInterface
    {
        $this->generateMainElement(Tag::OBJECT_ELEMENT);
        if ($this->getEntity()->getIdAttribute() !== null) {
            $this->generateAttribute(Attribute::ID, $this->getEntity()->getIdAttribute());
        }
        if ($this->getEntity()->getMimeType() !== null) {
            $this->generateAttribute(Attribute::MIME_TYPE, $this->getEntity()->getMimeType());
        }
        if ($this->getEntity()->getEncoding() !== null) {
            $this->generateAttribute(Attribute::ENCODING, $this->getEntity()->getEncoding());
        }
        if ($this->getEntity()->getSimpleContent() !== null) {
            $this->element->nodeValue = $this->getEntity()->getSimpleContent();
        }
        $this->generateChildren();

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    protected function getEntity(): ObjectType
    {
        return $this->entity;
    }

    /**
     * {@inheritDoc}
     */
    protected function setEntityType(): void
    {
        $this->entityType = ObjectType::class;
    }
}
