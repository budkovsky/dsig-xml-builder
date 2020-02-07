<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Adapter\DOMDocument;

use Budkovsky\DsigXmlBuilder\Abstraction\AdapterAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Entity\DigestMethodType;
use Budkovsky\DsigXmlBuilder\Enum\Attribute;
use Budkovsky\DsigXmlBuilder\Enum\Tag;
use Budkovsky\DsigXmlBuilder\Partial\AdapterChildrenTrait;

class DigestMethodAdapter extends AdapterAbstract
{
    use AdapterChildrenTrait;

    public function generate(): AdapterInterface
    {
        $this->generateMainElement(Tag::DIGEST_METHOD_ELEMENT);
        $this->generateAttribute(Attribute::ALGORITHM, $this->getEntity()->getAlgorithmAttribute());
        $this->generateChildren();

        return $this;
    }

    protected function getEntity(): DigestMethodType
    {
        return $this->entity;
    }

    protected function setEntityType(): void
    {
        $this->entityType = DigestMethodType::class;
    }
}
