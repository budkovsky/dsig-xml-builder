<?php
namespace Budkovsky\DsigXmlBuilder\Adapter\DOMDocument;

use Budkovsky\DsigXmlBuilder\Abstraction\AdapterAbstract;
use Budkovsky\DsigXmlBuilder\Entity\X509IssuerSerialType;
use Budkovsky\DsigXmlBuilder\Enum\Tag;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;

/**
 * X509IssuerSerial adapter
 */
class X509IssuerSerialAdapter extends AdapterAbstract
{
    /**
     * {@inheritDoc}
     */
    public function generate(): AdapterInterface
    {
        $this->generateMainElement(Tag::X509_ISSUER_SERIAL_ELEMENT);
        $this->generateX509IssuerSerialChild(
            Tag::X509_ISSUER_NAME_ELEMENT,
            $this->getEntity()->getX509IssuerName()
        );
        $this->generateX509IssuerSerialChild(
            Tag::X509_SERIAL_NUMBER_ELEMENT,
            $this->getEntity()->getX509SerialNumber()
        );

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getEntity(): X509IssuerSerialType
    {
        return $this->entity;
    }

    /**
     * {@inheritDoc}
     */
    protected function setEntityType(): void
    {
        $this->entityType = X509IssuerSerialType::class;
    }

    /**
     * Generates child element
     *
     * @param string $tag
     * @param string $value
     * @return X509IssuerSerialAdapter
     */
    private function generateX509IssuerSerialChild(
        string $tag,
        string $value
    ): X509IssuerSerialAdapter {
        $this->element->appendChild(
            $this->document->createElementNS(
                $this->namespace,
                $this->elementPrefix.$tag,
                $value
            )
        );

        return $this;
    }
}
