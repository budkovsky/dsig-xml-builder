<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Adapter\DOMDocument;

use Budkovsky\Aid\Abstraction\EntityInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Entity\TransformType;
use Budkovsky\DsigXmlBuilder\Entity\SimpleType\Xpath;
use Budkovsky\DsigXmlBuilder\Enum\Attribute;
use Budkovsky\DsigXmlBuilder\Enum\Tag;
use Budkovsky\DsigXmlBuilder\Partial\AdapterChildrenTrait;

class TransformAdapter extends AdapterAbstract
{
    use AdapterChildrenTrait;

    public function generate(): AdapterInterface
    {
        $this->generateMainElement(Tag::TRANSFORM_ELEMENT);
        $this->generateAttribute(Attribute::ALGORITHM, $this->getEntity()->getAlgorithmAttribute());
        $this->generateChildren();

        return $this;
    }

    protected function getNewElementFromEntity(EntityInterface $entity): \DOMElement
    {
        /** @var Xpath|EntityInterface $entity */
        return $entity instanceof Xpath ?
            $this->getNewElement(Tag::XPATH_ELEMENT, $entity->getSimpleContent())
            : $this->getNewElementByAdapter($entity, static::$anyAdapter)
        ;
    }

    protected function getEntity(): TransformType
    {
        return $this->entity;
    }

    protected function setEntityType(): void
    {
        $this->entityType = TransformType::class;
    }
}
