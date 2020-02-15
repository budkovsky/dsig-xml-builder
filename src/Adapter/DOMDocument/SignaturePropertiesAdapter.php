<?php
namespace Budkovsky\DsigXmlBuilder\Adapter\DOMDocument;

use Budkovsky\DsigXmlBuilder\Abstraction\AdapterAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Entity\SignaturePropertiesType;
use Budkovsky\DsigXmlBuilder\Enum\Attribute;
use Budkovsky\DsigXmlBuilder\Enum\Tag;

/**
 * SignatureProperties adapter
 */
class SignaturePropertiesAdapter extends AdapterAbstract
{
    /**
     * {@inheritDoc}
     */
    public function generate(): AdapterInterface
    {
        $this->generateMainElement(Tag::SIGNATURE_PROPERTIES_ELEMENT);
        if ($this->getEntity()->getIdAttribute() !== null) {
            $this->generateAttribute(Attribute::ID, $this->getEntity()->getIdAttribute());
        }
        foreach ($this->getEntity()->getSignatureProperties() as $signatureProperty) {
            $this->element->appendChild($this->getNewElementFromEntity($signatureProperty));
        }

        return $this;
    }

    /**

     * {@inheritDoc}
     */
    protected function getEntity(): SignaturePropertiesType
    {
        return $this->entity;
    }

    /**
     * {@inheritDoc}
     */
    protected function setEntityType(): void
    {
        $this->entityType = SignaturePropertiesType::class;
    }
}
