<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Adapter\DOMDocument;

use Budkovsky\DsigXmlBuilder\Abstraction\AdapterAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Entity\SignaturePropertyType;
use Budkovsky\DsigXmlBuilder\Enum\Attribute;
use Budkovsky\DsigXmlBuilder\Enum\Tag;
use Budkovsky\DsigXmlBuilder\Partial\AdapterChildrenTrait;

class SignaturePropertyAdapter extends AdapterAbstract
{
    use AdapterChildrenTrait;

    public function generate(): AdapterInterface
    {
        $this->generateMainElement(Tag::SIGNATURE_PROPERTY_ELEMENT);
        $this->generateAttribute(Attribute::TARGET, $this->getEntity()->getTargetAttribute());
        $this->generateAttribute(Attribute::ID, $this->getEntity()->getIdAttribute());
        $this->generateChildren();

        return $this;
    }

    protected function getEntity(): SignaturePropertyType
    {
        return $this->entity;
    }

    protected function setEntityType(): void
    {
        $this->entityType = SignaturePropertyType::class;
    }
}
