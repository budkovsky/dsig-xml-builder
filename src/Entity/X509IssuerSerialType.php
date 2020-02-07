<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Entity;

use Budkovsky\Aid\Abstraction\StaticFactoryInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\X509IssuerSerialAdapter;
use Budkovsky\DsigXmlBuilder\Partial\EntityAdapterTrait;

/**
 * X509IssuerSerialType entity
 *
 * ```xml
 * <complexType name="X509IssuerSerialType">
 *   <sequence>
 *     <element name="X509IssuerName" type="string"/>
 *     <element name="X509SerialNumber" type="integer"/>
 *   </sequence>
 * </complexType>
 * ```
 */
class X509IssuerSerialType implements DSigTypeInterface, StaticFactoryInterface
{
    use EntityAdapterTrait;

    /** @var string */
    private $x509IssuerName;

    /** @var int */
    private $x509SerialNumber;

    /**
     * X509IssuerSerialType entity static factory
     */
    public static function create(): X509IssuerSerialType
    {
        return new static;
    }

    /**
     * @return string|NULL
     */
    public function getX509IssuerName(): ?string
    {
        return $this->x509IssuerName;
    }

    /**
     * @param string $x509IssuerName
     * @return X509IssuerSerialType
     */
    public function setX509IssuerName(string $x509IssuerName): X509IssuerSerialType
    {
        $this->x509IssuerName = $x509IssuerName;

        return $this;
    }

    /**
     * @return int|NULL
     */
    public function getX509SerialNumber(): ?int
    {
        return $this->x509SerialNumber;
    }

    /**
     * @param int $x509SerialNumber
     * @return X509IssuerSerialType
     */
    public function setX509SerialNumber(int $x509SerialNumber): X509IssuerSerialType
    {
        $this->x509SerialNumber = $x509SerialNumber;

        return $this;
    }

    protected function getDefaultAdapter(): AdapterInterface
    {
        return new X509IssuerSerialAdapter();
    }
}
