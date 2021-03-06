<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Entity;

use Budkovsky\Aid\Abstraction\StaticFactoryInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\KeyInfoChildInterface;
use Budkovsky\DsigXmlBuilder\Partial\AnyTrait;
use Budkovsky\DsigXmlBuilder\Partial\EntityAdapterTrait;
use Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\KeyValueAdapter;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;

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
    use EntityAdapterTrait;

    /** @var DSAKeyValueType */
    protected $dsaKeyValue;

    /** @var RSAKeyValueType */
    protected $rsaKeyValue;

    /**
     * KeyValueType entity static factory
     * @return KeyValueType
     */
    public static function create(): KeyValueType
    {
        return new static();
    }

    /**
     * Getter of DSAKeyValueType
     *
     * @return DSAKeyValueType|NULL
     */
    public function getDsaKeyValue(): ?DSAKeyValueType
    {
        return $this->dsaKeyValue;
    }

    /**
     * Setter for KeyValueType
     *
     * @param DSAKeyValueType $dsaKeyValue
     * @return KeyValueType
     */
    public function setDsaKeyValue(DSAKeyValueType $dsaKeyValue): KeyValueType
    {
        $this->dsaKeyValue = $dsaKeyValue;

        return $this;
    }

    /**
     * Getter of RSAKeyValue
     *
     * @return RSAKeyValueType|NULL
     */
    public function getRsaKeyValue(): ?RSAKeyValueType
    {
        return $this->rsaKeyValue;
    }

    /**
     * Setter for RSAKeyValueType
     *
     * @param RSAKeyValueType $rsaKeyValue
     * @return KeyValueType
     */
    public function setRsaKeyValue(RSAKeyValueType $rsaKeyValue): KeyValueType
    {
        $this->rsaKeyValue = $rsaKeyValue;

        return $this;
    }

    /**
     * Returns default adapter for KeyValueType entity
     * @return KeyValueAdapter
     */
    protected function getDefaultAdapter(): AdapterInterface
    {
        return new KeyValueAdapter();
    }
}
