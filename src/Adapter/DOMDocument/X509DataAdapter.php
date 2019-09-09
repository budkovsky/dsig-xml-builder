<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Adapter\DOMDocument;

use Budkovsky\Aid\Abstraction\EntityInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Entity\X509DataType;
use Budkovsky\DsigXmlBuilder\Entity\X509IssuerSerialType;
use Budkovsky\DsigXmlBuilder\Entity\SimpleType\X509CRL;
use Budkovsky\DsigXmlBuilder\Entity\SimpleType\X509Certificate;
use Budkovsky\DsigXmlBuilder\Entity\SimpleType\X509SKI;
use Budkovsky\DsigXmlBuilder\Entity\SimpleType\X509SubjectName;
use Budkovsky\DsigXmlBuilder\Enum\Tag;
use Budkovsky\DsigXmlBuilder\Partial\AdapterChildrenTrait;

class X509DataAdapter extends AdapterAbstract
{
    use AdapterChildrenTrait;

    protected function getEntity(): X509DataType
    {
        return $this->entity;
    }

    public function generate(): AdapterInterface
    {
        $this->generateMainElement(Tag::X509_DATA_ELEMENT);
        $this->generateChildren();

        return $this;
    }

    protected function setEntityType(): void
    {
        $this->entityType = X509DataType::class;
    }

    protected function getNewElementFromEntity(EntityInterface $entity): \DOMElement
    {
        /** @var SimpleContentInterface|EntityInterface|X509IssuerSerialType */
        switch (true) {

            case $entity instanceof X509IssuerSerialType:
                $element = $this->getNewElementByAdapter($entity, X509IssuerSerialAdapter::create());
                break;

            case $entity instanceof X509SKI:
                $element = $this->getNewElement(Tag::X509_SKI_ELEMENT, $entity->getSimpleContent());
                break;

            case $entity instanceof X509SubjectName:
                $element = $this->getNewElement(Tag::X509_SUBJECT_NAME_ELEMENT, $entity->getSimpleContent());
                break;

            case $entity instanceof X509Certificate:
                $element = $this->getNewElement(Tag::X509_CERTIFICATE_ELEMENT, $entity->getSimpleContent());
                break;

            case $entity instanceof X509CRL:
                $element = $this->getNewElement(Tag::X509_CRL_ELEMENT, $entity->getSimpleContent());
                break;

            default:
                $element = $this->getNewElementByAdapter($entity, static::$anyAdapter);
                break;
        }

        return $element;
    }
}
