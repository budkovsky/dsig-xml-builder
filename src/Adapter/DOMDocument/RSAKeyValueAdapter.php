<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Adapter\DOMDocument;

use Budkovsky\DsigXmlBuilder\Abstraction\AdapterAbstract;
use Budkovsky\DsigXmlBuilder\Entity\RSAKeyValueType;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Enum\Tag;

/**
 * RSAKeyValue adapter
 */
class RSAKeyValueAdapter extends AdapterAbstract
{
    /**
     * {@inheritDoc}
     */
    public function generate(): AdapterInterface
    {
        $this->generateMainElement(Tag::RSA_KEY_VALUE_ELEMENT);
        $this->generateChild(Tag::MODULUS_ELEMENT, $this->getEntity()->getModulus());
        $this->generateChild(Tag::EXPONENT_ELEMENT, $this->getEntity()->getExponent());

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    protected function getEntity(): RSAKeyValueType
    {
        return $this->entity;
    }

    /**
     * {@inheritDoc}
     */
    protected function setEntityType(): void
    {
        $this->entityType = RSAKeyValueType::class;
    }
}
