<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Entity;

use Budkovsky\Aid\Abstraction\StaticFactoryInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\KeyInfoChildInterface;
use Budkovsky\DsigXmlBuilder\Exception\RestrictionException;
use Budkovsky\DsigXmlBuilder\Helper\RestrictionHelper;
use Budkovsky\DsigXmlBuilder\Partial\ChildrenTrait;

/**
 * PGPDataType entity
 *
 * ```xml
 * <complexType name="PGPDataType">
 *   <choice>
 *     <sequence>
 *       <element name="PGPKeyID" type="base64Binary"/>
 *       <element name="PGPKeyPacket" type="base64Binary" minOccurs="0"/>
 *       <any namespace="##other" processContents="lax" minOccurs="0" maxOccurs="unbounded"/>
 *     </sequence>
 *     <sequence>
 *       <element name="PGPKeyPacket" type="base64Binary"/>
 *       <any namespace="##other" processContents="lax" minOccurs="0" maxOccurs="unbounded"/>
 *     </sequence>
 *   </choice>
 * </complexType>
 * ```
 */
class PGPDataType implements DSigTypeInterface, StaticFactoryInterface, KeyInfoChildInterface
{
    use ChildrenTrait;

    /** @var string */
    private $pgpKeyId;

    /** @var string */
    private $pgpKeyPacket;

    /**
     * PGPDataType entity static factory
     */
    public static function create(): PGPDataType
    {
        return new static;
    }

    /**
     * @return string|NULL
     */
    public function getPgpKeyId(): ?string
    {
        return $this->pgpKeyId;
    }

    /**
     * @param string $pgpKeyId
     * @return PGPDataType
     */
    public function setPgpKeyId(string $pgpKeyId): PGPDataType
    {
        if (!RestrictionHelper::isBase64($pgpKeyId)) {
            throw new RestrictionException('PGPKeyID must be base64 encoded string');
        }

        $this->pgpKeyId = $pgpKeyId;

        return $this;
    }

    /**
     * @return string|NULL
     */
    public function getPgpKeyPacket(): ?string
    {
        return $this->pgpKeyPacket;
    }

    /**
     * @param string $pgpKeyPacket
     * @return PGPDataType
     */
    public function setPgpKeyPacket(string $pgpKeyPacket): PGPDataType
    {
        if (!RestrictionHelper::isBase64($pgpKeyPacket)) {
            throw new RestrictionException('PGPKeyPacket must be base64 encoded string');
        }
        $this->pgpKeyPacket = $pgpKeyPacket;

        return $this;
    }

}
