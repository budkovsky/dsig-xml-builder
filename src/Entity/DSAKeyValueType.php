<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Entity;

use Budkovsky\Aid\Abstraction\StaticFactoryInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;

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
     * @return string|NULL
     */
    public function getP(): ?string
    {
        return $this->p;
    }

    /**
     * @return string|NULL
     */
    public function getQ(): ?string
    {
        return $this->q;
    }

    /**
     * @return string|NULL
     */
    public function getG(): ?string
    {
        return $this->g;
    }

    /**
     * @return string|NULL
     */
    public function getY(): ?string
    {
        return $this->y;
    }

    /**
     * @return string|NULL
     */
    public function getJ(): ?string
    {
        return $this->j;
    }

    /**
     * @return string|NULL
     */
    public function getSeed(): ?string
    {
        return $this->seed;
    }

    /**
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
     * @param string $q
     * @return DSAKeyValueType
     */
    public function setQ(string $q): DSAKeyValueType
    {
        $this->q = $q;

        return $this;
    }

    /**
     * @param string $g
     * @return DSAKeyValueType
     */
    public function setG(string $g): DSAKeyValueType
    {
        $this->g = $g;

        return $this;
    }

    /**
     * @param string $y
     * @return DSAKeyValueType
     */
    public function setY(string $y): DSAKeyValueType
    {
        $this->y = $y;

        return $this;
    }

    /**
     * @param string $j
     * @return DSAKeyValueType
     */
    public function setJ(string $j): DSAKeyValueType
    {
        $this->j = $j;

        return $this;
    }

    /**
     * @param string $seed
     * @return DSAKeyValueType
     */
    public function setSeed(string $seed): DSAKeyValueType
    {
        $this->seed = $seed;

        return $this;
    }

    /**
     * @param string $pgenCounter
     * @return DSAKeyValueType
     */
    public function setPgenCounter(string $pgenCounter): DSAKeyValueType
    {
        $this->pgenCounter = $pgenCounter;

        return $this;
    }
}
