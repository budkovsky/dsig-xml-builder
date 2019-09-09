<?php
namespace Budkovsky\DsigXmlBuilder\Adapter\DOMDocument;

use Budkovsky\DsigXmlBuilder\Abstraction\AdapterAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Entity\SignaturePropertiesType;
use Budkovsky\DsigXmlBuilder\Enum\Tag;
use Budkovsky\DsigXmlBuilder\Enum\Attribute;

class SignaturePropertiesAdapter extends AdapterAbstract
{
    public function generate(): AdapterInterface
    {
        $this->generateMainElement(Tag::SIGNATURE_PROPERTIES_ELEMENT);
        if ($this->getEntity()->getIdAttribute() !== null) {
            $this->generateAttribute(Attribute::ID, $this->getEntity()->getIdAttribute());
        }
        foreach ($this->getEntity()->getSignatureProperties() as $signatureProperty) {
            $this->element->appendChild($this->getNewElementByAdapter(
                $signatureProperty,
                SignaturePropertyAdapter::create()
            ));
        }

        return $this;
    }

    protected function getEntity(): SignaturePropertiesType
    {
        return $this->entity;
    }

    protected function setEntityType(): void
    {
        $this->entityType = SignaturePropertiesType::class;
    }
}
