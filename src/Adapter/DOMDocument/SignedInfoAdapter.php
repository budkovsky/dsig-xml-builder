<?php
namespace Budkovsky\DsigXmlBuilder\Adapter\DOMDocument;

use Budkovsky\DsigXmlBuilder\Abstraction\AdapterAbstract;
use Budkovsky\DsigXmlBuilder\Entity\SignedInfoType;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Enum\Tag;
use Budkovsky\DsigXmlBuilder\Partial\AdapterReferencesTrait;
use Budkovsky\DsigXmlBuilder\Enum\Attribute;

class SignedInfoAdapter extends AdapterAbstract
{
    use AdapterReferencesTrait;

    public function generate(): AdapterInterface
    {
        $this->generateMainElement(Tag::SIGNED_INFO_ELEMENT);
        $this->element->appendChild(
            $this->getNewElementFromEntity(
                $this->getEntity()->getCanonicalizationMethod()
            )
        );
        $this->element->appendChild(
            $this->getNewElementFromEntity(
                $this->getEntity()->getSignatureMethod()
            )
        );
        $this->generateReferenceElements($this->getEntity()->getReferences());
        if ($this->getEntity()->getIdAttribute() !== null) {
            $this->generateAttribute(Attribute::ID, $this->getEntity()->getIdAttribute());
        }

        return $this;
    }

    protected function getEntity(): SignedInfoType
    {
        return $this->entity;
    }

    protected function setEntityType(): void
    {
        $this->entityType = SignedInfoType::class;
    }
}
