<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Adapter\DOMDocument;

use Budkovsky\DsigXmlBuilder\Abstraction\AdapterAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Entity\ReferenceType;
use Budkovsky\DsigXmlBuilder\Enum\Attribute;
use Budkovsky\DsigXmlBuilder\Enum\Tag;
use Budkovsky\DsigXmlBuilder\Partial\AdapterTransformsTrait;

/**
 * Reference adapter
 */
class ReferenceAdapter extends AdapterAbstract
{
    use AdapterTransformsTrait;

    /**
     * {@inheritDoc}
     */
    public function generate(): AdapterInterface
    {
        // main element
        $this->generateMainElement(Tag::REFERENCE_ELEMENT);

        // Transforms
        if ($this->getEntity()->getTransforms() !== null && $this->getEntity()->getTransforms()->count() > 0) {
            $this->element->appendChild(
                $this->getTransformsElement(
                    $this->getEntity()->getTransforms()
                )
            );
        }

        // DigestMethod
        $this->element->appendChild(
            $this->getNewElementFromEntity(
                $this->getEntity()->getDigestMethod()
            )
        );

        // DigestValue
        $this->generateChild(Tag::DIGEST_VALUE_ELEMENT, $this->getEntity()->getDigestValue() ?? '');

        // Id attribute
        if ($this->getEntity()->getIdAttribute() !== null) {
            $this->generateAttribute(Attribute::ID, $this->getEntity()->getIdAttribute());
        }

        // URI attribute
        if ($this->getEntity()->getUriAttribute() !== null) {
            $this->generateAttribute(Attribute::URI, $this->getEntity()->getUriAttribute());
        }

        // Type attribute
        if ($this->getEntity()->getTypeAttribute() !== null) {
            $this->generateAttribute(Attribute::TYPE, $this->getEntity()->getTypeAttribute());
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    protected function getEntity(): ReferenceType
    {
        return $this->entity;
    }

    /**
     * {@inheritDoc}
     */
    protected function setEntityType(): void
    {
        $this->entityType = ReferenceType::class;
    }
}
