<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Adapter\DOMDocument;

use Budkovsky\Aid\Abstraction\CollectionAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Entity\SignatureType;
use Budkovsky\DsigXmlBuilder\Enum\Attribute;
use Budkovsky\DsigXmlBuilder\Enum\Tag;

class SignatureAdapter extends AdapterAbstract
{
    public function generate(): AdapterInterface
    {
        // Signature element
        $this->generateMainElement(Tag::SIGNATURE_ELEMENT);

        // SignedInfo element
        $this->element->appendChild(
            $this->getNewElementFromEntity(
                $this->getEntity()->getSignedInfo()
            )
        );

        // SignatureValue element
        $this->element->appendChild(
            $this->getNewElementFromEntity(
                $this->getEntity()->getSignatureValue()
            )
        );

        // KeyInfo element
        if ($this->getEntity()->getKeyInfo()) {
            $this->element->appendChild(
                $this->getNewElementFromEntity(
                    $this->getEntity()->getKeyInfo()
                )
            );
        }

        //Object elements
        $this->generateElementsFromCollection(
            $this->getEntity()->getObjects()
        );

        // Id attribute
        if ($this->getEntity()->getIdAttribute() !== null) {
            $this->generateAttribute(Attribute::ID, $this->getEntity()->getIdAttribute());
        }

        return $this;
    }

    protected function generateElementsFromCollection(?CollectionAbstract $collection): SignatureAdapter
    {
        if ($collection !== null) {
            foreach ($collection as $entity) {
                $this->element->appendChild(
                    $this->getNewElementFromEntity($entity)
                );
            }
        }

        return $this;
    }

    protected function getEntity(): SignatureType
    {
        return $this->entity;
    }

    protected function setEntityType(): void
    {
        $this->entityType = SignatureType::class;
    }
}
