<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Entity;

use Budkovsky\Aid\Abstraction\StaticFactoryInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Partial\EntityAdapterTrait;
use Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\DSAKeyValueAdapter;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;

/**
 * DSAKeyValueType entity
 *
 * ```xml
 * <complexType name="DSAKeyValueType">
 *   <sequence>
 *     <sequence minOccurs="0">
 *       <element name="P" type="ds:CryptoBinary"/>
 *       <element name="Q" type="ds:CryptoBinary"/>
 *     </sequence>
 *     <element name="G" type="ds:CryptoBinary" minOccurs="0"/>
 *     <element name="Y" type="ds:CryptoBinary"/>
 *     <element name="J" type="ds:CryptoBinary" minOccurs="0"/>
 *     <sequence minOccurs="0">
 *       <element name="Seed" type="ds:CryptoBinary"/>
 *       <element name="PgenCounter" type="ds:CryptoBinary"/>
 *     </sequence>
 *   </sequence>
 * </complexType>
 * ```
 */
class DSAKeyValueType implements DSigTypeInterface, StaticFactoryInterface
{
    use EntityAdapterTrait;

    /** @var string */
    private $p;

    /** @var string */
    private $q;

    /** @var string */
    private $g;

    /** @var string */
    private $y;

    /** @var string */
    private $j;

    /** @var string */
    private $seed;

    /** @var string */
    private $pgenCounter;

    /**
     * DSAKeyValueType entity static factory
     * @return DSAKeyValueType
     */
    public static function create(): DSAKeyValueType
    {
        return new static;
    }

    /**
     * Getter of `P` value
     *
     * @return string|NULL
     */
    public function getP(): ?string
    {
        return $this->p;
    }

    /**
     * Getter of `Q` value
     *
     * @return string|NULL
     */
    public function getQ(): ?string
    {
        return $this->q;
    }

    /**
     * Getter of `G` value
     *
     * @return string|NULL
     */
    public function getG(): ?string
    {
        return $this->g;
    }

    /**
     * Getter of `Y` value
     *
     * @return string|NULL
     */
    public function getY(): ?string
    {
        return $this->y;
    }

    /**
     * Getter of `J` value
     *
     * @return string|NULL
     */
    public function getJ(): ?string
    {
        return $this->j;
    }

    /**
     * Getter of `seed` value
     *
     * @return string|NULL
     */
    public function getSeed(): ?string
    {
        return $this->seed;
    }

    /**
     * Getter of `pgenCounter` value
     *
     * @return string|NULL
     */
    public function getPgenCounter(): ?string
    {
        return $this->pgenCounter;
    }

    /**
     * @param string $p
     * @return DSAKeyValueType
     */
    public function setP($p): DSAKeyValueType
    {
        $this->p = $p;

        return $this;
    }

    /**
     * Setter for `Q` value
     *
     * @param string $q
     * @return DSAKeyValueType
     */
    public function setQ(string $q): DSAKeyValueType
    {
        $this->q = $q;

        return $this;
    }

    /**
     * Setter for `G` value
     *
     * @param string $g
     * @return DSAKeyValueType
     */
    public function setG(string $g): DSAKeyValueType
    {
        $this->g = $g;

        return $this;
    }

    /**
     * Setter for `Y` value
     *
     * @param string $y
     * @return DSAKeyValueType
     */
    public function setY(string $y): DSAKeyValueType
    {
        $this->y = $y;

        return $this;
    }

    /**
     * Setter for `J` value
     *
     * @param string $j
     * @return DSAKeyValueType
     */
    public function setJ(string $j): DSAKeyValueType
    {
        $this->j = $j;

        return $this;
    }

    /**
     * Setter for `seed` value
     *
     * @param string $seed
     * @return DSAKeyValueType
     */
    public function setSeed(string $seed): DSAKeyValueType
    {
        $this->seed = $seed;

        return $this;
    }

    /**
     * Setter for `pgenCounter` value
     *
     * @param string $pgenCounter
     * @return DSAKeyValueType
     */
    public function setPgenCounter(string $pgenCounter): DSAKeyValueType
    {
        $this->pgenCounter = $pgenCounter;

        return $this;
    }

    /**
     * Returns default adapter for DSAKeyValueType entity
     *
     * @return DSAKeyValueAdapter
     */
    protected function getDefaultAdapter(): AdapterInterface
    {
        return new DSAKeyValueAdapter();
    }
}
