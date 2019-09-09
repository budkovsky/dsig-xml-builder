<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Adapter\DOMDocument;

use Budkovsky\Aid\Abstraction\EntityInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterAbstract;
use Budkovsky\DsigXmlBuilder\Partial\AdapterChildrenTrait;
use Budkovsky\DsigXmlBuilder\Entity\SignatureMethodType;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Enum\Tag;
use Budkovsky\DsigXmlBuilder\Enum\Attribute;

class SignatureMethodAdapter extends AdapterAbstract
{
    use AdapterChildrenTrait;

    public function generate(): AdapterInterface
    {
        $this->generateMainElement(Tag::SIGNATURE_METHOD_ELEMENT);
        $this->generateAttribute(Attribute::ALGORITHM, $this->getEntity()->getAlgorithmAttribute());
        if ($this->getEntity()->getHmacOutputLength() !== null) {
            $this->generateChild(Tag::HMAC_OUTPUT_LENGTH_ELEMENT, $this->getEntity()->getHmacOutputLength());
        }
        $this->generateChildren();

        return $this;
    }

    protected function getNewElementFromEntity(EntityInterface $entity): \DOMElement
    {
        return $this->getNewElementByAdapter($entity, $this->anyAdapter);
    }

    protected function getEntity(): SignatureMethodType
    {
        return $this->entity;
    }

    protected function setEntityType(): void
    {
        $this->entityType = SignatureMethodType::class;
    }
}
