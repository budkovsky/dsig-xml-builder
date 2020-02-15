<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Adapter\DOMDocument;

use Budkovsky\DsigXmlBuilder\Abstraction\AdapterAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Entity\SignatureMethodType;
use Budkovsky\DsigXmlBuilder\Enum\Attribute;
use Budkovsky\DsigXmlBuilder\Enum\Tag;
use Budkovsky\DsigXmlBuilder\Partial\AdapterChildrenTrait;

/**
 * SignatureMethod adapter
 */
class SignatureMethodAdapter extends AdapterAbstract
{
    use AdapterChildrenTrait;

    /**
     * {@inheritDoc}
     */
    public function generate(): AdapterInterface
    {
        $this->generateMainElement(Tag::SIGNATURE_METHOD_ELEMENT);
        $this->generateAttribute(Attribute::ALGORITHM, $this->getEntity()->getAlgorithmAttribute());
        if ($this->getEntity()->getHmacOutputLength() !== null) {
            $this->generateChild(Tag::HMAC_OUTPUT_LENGTH_ELEMENT, $this->getEntity()->getHmacOutputLength());
        }
        $this->generateChildren();

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    protected function getEntity(): SignatureMethodType
    {
        return $this->entity;
    }

    /**
     * {@inheritDoc}
     */
    protected function setEntityType(): void
    {
        $this->entityType = SignatureMethodType::class;
    }
}
