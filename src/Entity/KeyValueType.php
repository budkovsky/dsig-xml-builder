<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Entity;

use Budkovsky\Aid\Abstraction\StaticFactoryInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\KeyInfoChildInterface;
use Budkovsky\DsigXmlBuilder\Partial\AnyTrait;

/**
 * KeyValueType entity
 *
 * ```xml
 * <complexType name="KeyValueType" mixed="true">
 *   <choice>
 *     <element ref="ds:DSAKeyValue"/>
 *     <element ref="ds:RSAKeyValue"/>
 *     <any namespace="##other" processContents="lax"/>
 *   </choice>
 * </complexType>
 * ```
 */
class KeyValueType implements DSigTypeInterface, StaticFactoryInterface, KeyInfoChildInterface
{
    use AnyTrait;

    /** @var DSAKeyValueType */
    protected $dsaKeyValue;

    /** @var RSAKeyValueType */
    protected $rsaKeyValue;

    /**
     * KeyValueType entity constructor
     * @param string $choice
     */
    public function __construct()
    {
    }

    /**
     * KeyValueType entity static factory
     * @return KeyValueType
     */
    public static function create(): KeyValueType
    {
        return new static();
    }

    /**
     * @return DSAKeyValueType|NULL
     */
    public function getDsaKeyValue(): ?DSAKeyValueType
    {
        return $this->dsaKeyValue;
    }

    /**
     * @param DSAKeyValueType $dsaKeyValue
     * @return KeyValueType
     */
    public function setDsaKeyValue(DSAKeyValueType $dsaKeyValue): KeyValueType
    {
        $this->dsaKeyValue = $dsaKeyValue;

        return $this;
    }

    /**
     * @return RSAKeyValueType|NULL
     */
    public function getRsaKeyValue(): ?RSAKeyValueType
    {
        return $this->rsaKeyValue;
    }

    /**
     * @param RSAKeyValueType $rsaKeyValue
     * @return KeyValueType
     */
    public function setRsaKeyValue(RSAKeyValueType $rsaKeyValue): KeyValueType
    {
        $this->rsaKeyValue = $rsaKeyValue;

        return $this;
    }
}
