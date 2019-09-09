<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Adapter\DOMDocument;

use Budkovsky\Aid\Abstraction\EntityInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Entity\KeyInfoType;
use Budkovsky\DsigXmlBuilder\Entity\KeyValueType;
use Budkovsky\DsigXmlBuilder\Entity\PGPDataType;
use Budkovsky\DsigXmlBuilder\Entity\RetrievalMethodType;
use Budkovsky\DsigXmlBuilder\Entity\SPKIDataType;
use Budkovsky\DsigXmlBuilder\Entity\X509DataType;
use Budkovsky\DsigXmlBuilder\Entity\SimpleType\KeyName;
use Budkovsky\DsigXmlBuilder\Entity\SimpleType\MgmtData;
use Budkovsky\DsigXmlBuilder\Enum\Attribute;
use Budkovsky\DsigXmlBuilder\Enum\Tag;
use Budkovsky\DsigXmlBuilder\Partial\AdapterChildrenTrait;

class KeyInfoAdapter extends AdapterAbstract
{
    use AdapterChildrenTrait;

    public function generate(): AdapterInterface
    {
        $this->generateMainElement(Tag::KEY_INFO_ELEMENT);
        $this->generateChildren();
        if ($this->getEntity()->getIdAttribute() !== null) {
            $this->generateAttribute(Attribute::ID, $this->getEntity()->getIdAttribute());
        }

        return $this;
    }

    protected function getNewElementFromEntity(EntityInterface $entity): \DOMElement
    {
        /** @var SimpleContentInterface|EntityInterface */
        switch (true) {

            case $entity instanceof KeyName:
                $element = $this->getNewElement(Tag::KEY_NAME_ELEMENT, $entity->getSimpleContent());
                break;

            case $entity instanceof KeyValueType:
                $element = $this->getNewElementByAdapter($entity, new KeyValueAdapter());
                break;

            case $entity instanceof RetrievalMethodType:
                $element = $this->getNewElementByAdapter($entity, new RetrievalMethodAdapter());
                break;

            case $entity instanceof  X509DataType:
                $element = $this->getNewElementByAdapter($entity, new X509DataAdapter());
                break;

            case $entity instanceof PGPDataType:
                $element = $this->getNewElementByAdapter($entity, new PGPDataAdapter());
                break;

            case $entity instanceof SPKIDataType:
                $element = $this->getNewElementByAdapter($entity, new SPKIDataAdapter());
                break;

            case $entity instanceof MgmtData:
                $element = $this->getNewElement(Tag::MGMT_DATA_ELEMENT, $entity->getSimpleContent());
                break;

            default:
                $element = $this->getNewElementByAdapter($entity, $this->anyAdapter);
                break;

        }

        return $element;
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

