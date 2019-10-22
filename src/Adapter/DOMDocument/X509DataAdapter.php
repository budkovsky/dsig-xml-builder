<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Adapter\DOMDocument;

use Budkovsky\DsigXmlBuilder\Abstraction\AdapterAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Entity\X509DataType;
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
}
