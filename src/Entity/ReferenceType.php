<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Entity;

use Budkovsky\Aid\Abstraction\StaticFactoryInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Collection\TransformTypeCollection;
use Budkovsky\DsigXmlBuilder\Partial\IdAttributeTrait;
use Budkovsky\DsigXmlBuilder\Partial\TypeAttributeTrait;
use Budkovsky\DsigXmlBuilder\Partial\UriAttributeTrait;
use Budkovsky\DsigXmlBuilder\Partial\EntityAdapterTrait;
use Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\ReferenceAdapter;

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
    use EntityAdapterTrait;

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
     *
     * @return ReferenceType
     */
    public static function create(): ReferenceType
    {
        return new static();
    }

    /**
     * Getter of transform collection
     *
     * @return TransformTypeCollection|NULL
     */
    public function getTransforms(): ?TransformTypeCollection
    {
        return $this->transforms;
    }

    /**
     * Setter for transform collection
     *
     * @param TransformTypeCollection $transforms
     * @return ReferenceType
     */
    public function setTransforms(TransformTypeCollection $transforms): ReferenceType
    {
        $this->transforms = $transforms;

        return $this;
    }

    /**
     * Adds transform to the collection
     *
     * @param TransformType $transform
     * @return ReferenceType
     */
    public function addTransform(TransformType $transform): ReferenceType
    {
        $this->transforms->add($transform);

        return $this;
    }

    /**
     *
     * @return CanonicalizationMethodType|NULL
     */
    public function getDigestMethod(): ?DigestMethodType
    {
        return $this->digestMethod;
    }

    /**
     * Setter for digest method
     *
     * @param DigestMethodType $digestMethod
     * @return ReferenceType
     */
    public function setDigestMethod(DigestMethodType $digestMethod): ReferenceType
    {
        $this->digestMethod = $digestMethod;

        return $this;
    }

    /**
     * Getter of digest value
     *
     * @return string|NULL
     */
    public function getDigestValue(): ?string
    {
        return $this->digestValue;
    }

    /**
     * Setter for digest value
     *
     * @param string $digestValue
     * @return \Budkovsky\DsigXmlBuilder\Entity\ReferenceType
     */
    public function setDigestValue(string $digestValue): ReferenceType
    {
        $this->digestValue = $digestValue;

        return $this;
    }
    /**
     * Returns default adapter for ReferenceType entity
     * @return ReferenceAdapter
     */

    protected function getDefaultAdapter(): AdapterInterface
    {
        return new ReferenceAdapter();
    }
}
