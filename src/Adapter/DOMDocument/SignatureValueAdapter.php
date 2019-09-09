<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Adapter\DOMDocument;

use Budkovsky\DsigXmlBuilder\Abstraction\AdapterAbstract;
use Budkovsky\DsigXmlBuilder\Entity\SignatureValueType;
use Budkovsky\DsigXmlBuilder\Enum\Tag;
use Budkovsky\DsigXmlBuilder\Enum\Attribute;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;

class SignatureValueAdapter extends AdapterAbstract
{
    public function getEntity(): SignatureValueType
    {
        return $this->entity;
    }

    public function generate(): AdapterInterface
    {
        $this->generateMainElement(
            Tag::SIGNATURE_VALUE_ELEMENT,
            $this->getEntity()->getSimpleContent()
        );

        $this->generateAttribute(
            Attribute::ID,
            $this->getEntity()->getIdAttribute()
        );

        return $this;
    }

    protected function setEntityType(): void
    {
        $this->entityType = SignatureValueType::class;
    }
}
