<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Entity;

use Budkovsky\Aid\Abstraction\StaticFactoryInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Partial\EntityAdapterTrait;
use Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\RSAKeyValueAdapter;

/**
 * RSAKeyValueType entity
 *
 * ```xml
 * <complexType name="RSAKeyValueType">
 *   <sequence>
 *     <element name="Modulus" type="ds:CryptoBinary"/>
 *     <element name="Exponent" type="ds:CryptoBinary"/>
 *   </sequence>
 * </complexType>
 * ```
 */
class RSAKeyValueType implements DSigTypeInterface, StaticFactoryInterface
{
    use EntityAdapterTrait;

    /** @var string */
    private $modulus;

    /** @var string */
    private $exponent;

    /**
     * RSAKeyValeType entity static factory
     * @return RSAKeyValueType
     */
    public static function create(): RSAKeyValueType
    {
        return new static;
    }

    /**
     * @return string|NULL
     */
    public function getModulus(): ?string
    {
        return $this->modulus;
    }

    /**
     * @return string|NULL
     */
    public function getExponent(): ?string
    {
        return $this->exponent;
    }

    /**
     * @param string $modulus
     * @return RSAKeyValueType
     */
    public function setModulus(string $modulus): RSAKeyValueType
    {
        $this->modulus = $modulus;

        return $this;
    }

    /**
     * @param string $exponent
     * @return RSAKeyValueType
     */
    public function setExponent(string $exponent): RSAKeyValueType
    {
        $this->exponent = $exponent;

        return $this;
    }

    protected function getDefaultAdapter(): AdapterInterface
    {
        return new RSAKeyValueAdapter();
    }
}
