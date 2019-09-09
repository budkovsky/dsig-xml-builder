<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Adapter\DOMDocument;

use Budkovsky\Aid\Abstraction\EntityInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Entity\SPKIDataType;
use Budkovsky\DsigXmlBuilder\Entity\SimpleType\SPKISexp;
use Budkovsky\DsigXmlBuilder\Enum\Tag;
use Budkovsky\DsigXmlBuilder\Partial\AdapterChildrenTrait;

class SPKIDataAdapter extends AdapterAbstract
{
    use AdapterChildrenTrait;

    public function generate(): AdapterInterface
    {
        $this->generateMainElement(Tag::SPKI_DATA_ELEMENT);
        $this->generateChildren();

        return $this;
    }

    protected function getNewElementFromEntity(EntityInterface $entity): \DOMElement
    {
        /** @var SPKISexp|EntityInterface $entity */
        return $entity instanceof SPKISexp ?
            $this->getNewElement(Tag::SPKI_SEXP_ELEMENT, $entity->getSimpleContent())
            : $this->getNewElementByAdapter($entity, static::$anyAdapter)
        ;
    }

    protected function getEntity(): SPKIDataType
    {
        return $this->entity;
    }

    protected function setEntityType(): void
    {
        $this->entityType = SPKIDataType::class;
    }
}
