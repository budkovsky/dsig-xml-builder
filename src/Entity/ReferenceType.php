<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Entity;

use Budkovsky\Aid\Abstraction\StaticFactoryInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Collection\TransformTypeCollection;
use Budkovsky\DsigXmlBuilder\Partial\IdAttributeTrait;
use Budkovsky\DsigXmlBuilder\Partial\TypeAttributeTrait;
use Budkovsky\DsigXmlBuilder\Partial\UriAttributeTrait;

/**
 * ReferenceType entity
 *
 * ```xml
 * <complexType name="ReferenceType">
 *   <sequence>
 *     <element ref="ds:Transforms" minOccurs="0"/>
 *     <element ref="ds:DigestMethod"/>
 *     <element ref="ds:DigestValue"/>
 *   </sequence>
 *   <attribute name="Id" type="ID" use="optional"/>
 *   <attribute name="URI" type="anyURI" use="optional"/>
 *   <attribute name="Type" type="anyURI" use="optional"/>
 * </complexType>
 * ```
 */
class ReferenceType implements DSigTypeInterface, StaticFactoryInterface
{
    use IdAttributeTrait;
    use UriAttributeTrait;
    use TypeAttributeTrait;

    /** @var TransformTypeCollection */
    private $transforms;

    /** @var DigestMethodType */
    private $digestMethod;

    /** @var string */
    private $digestValue;

    /**
     * Reference entity constructor
     */
    public function __construct()
    {
        $this->transforms = new TransformTypeCollection();
    }

    /**
     * ReferenceType entity static factory
     * @return ReferenceType
     */
    public static function create(): ReferenceType
    {
        return new static;
    }

    /**
     * @return TransformTypeCollection|NULL
     */
    public function getTransforms(): ?TransformTypeCollection
    {
        return $this->transforms;
    }

    /**
     * @param TransformTypeCollection $transforms
     * @return ReferenceType
     */
    public function setTransforms(TransformTypeCollection $transforms): ReferenceType
    {
        $this->transforms = $transforms;

        return $this;
    }

    /**
     * @param TransformType $transform
     * @return ReferenceType
     */
    public function addTransform(TransformType $transform): ReferenceType
    {
        $this->transforms->add($transform);

        return $this;
    }

    /**
     * @return CanonicalizationMethodType|NULL
     */
    public function getDigestMethod(): ?DigestMethodType
    {
        return $this->digestMethod;
    }

    /**
     * @param DigestMethodType $digestMethod
     * @return ReferenceType
     */
    public function setDigestMethod(DigestMethodType $digestMethod): ReferenceType
    {
        $this->digestMethod = $digestMethod;

        return $this;
    }

    /**
     * @return string|NULL
     */
    public function getDigestValue(): ?string
    {
        return $this->digestValue;
    }

    /**
     * @param string $digestValue
     * @return \Budkovsky\DsigXmlBuilder\Entity\ReferenceType
     */
    public function setDigestValue(string $digestValue): ReferenceType
    {
        $this->digestValue = $digestValue;

        return $this;
    }
}
