<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Adapter\DOMDocument;

use Budkovsky\DsigXmlBuilder\Abstraction\AdapterAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Entity\KeyInfoType;
use Budkovsky\DsigXmlBuilder\Enum\Attribute;
use Budkovsky\DsigXmlBuilder\Enum\Tag;
use Budkovsky\DsigXmlBuilder\Partial\AdapterChildrenTrait;

class KeyInfoAdapter extends AdapterAbstract
{
    use AdapterChildrenTrait;

    public function generate(): AdapterInterface
    {
        $this->generateMainElement(Tag::KEY_INFO_ELEMENT);
        if ($this->getEntity()->getChildren()) {
            foreach ($this->getEntity()->getChildren() as $childEntity) {
                $this->getDOMElement()->appendChild(
                    $this->getNewElementFromEntity($childEntity)
                );
            }
        }
        if ($this->getEntity()->getIdAttribute() !== null) {
            $this->generateAttribute(Attribute::ID, $this->getEntity()->getIdAttribute());
        }

        return $this;
    }

    protected function getEntity(): KeyInfoType
    {
        return $this->entity;
    }

    protected function setEntityType(): void
    {
        $this->entityType = KeyInfoType::class;
    }
}
