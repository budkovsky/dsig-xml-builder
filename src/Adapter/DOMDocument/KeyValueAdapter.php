<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Adapter\DOMDocument;

use Budkovsky\DsigXmlBuilder\Abstraction\AdapterAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Entity\KeyValueType;
use Budkovsky\DsigXmlBuilder\Enum\Tag;

class KeyValueAdapter extends AdapterAbstract
{

    public function generate(): AdapterInterface
    {
        $this->generateMainElement(Tag::KEY_VALUE_ELEMENT);

        if ($this->getEntity()->getDsaKeyValue() !== null) {
            $this->element->appendChild($this->getNewElementFromEntity(
                $this->getEntity()->getDsaKeyValue()
            ));
        }
        if ($this->getEntity()->getRsaKeyValue() !== null) {
            $this->element->appendChild($this->getNewElementFromEntity(
                $this->getEntity()->getRsaKeyValue()
            ));
        }
        if ($this->getEntity()->getAny() !== null) {
            $this->element->appendChild($this->getNewElementFromEntity(
                $this->getEntity()->getAny()
            ));
        }

        return $this;
    }

    protected function getEntity(): KeyValueType
    {
        return $this->entity;
    }

    protected function setEntityType(): void
    {
        $this->entityType = KeyValueType::class;
    }
}
