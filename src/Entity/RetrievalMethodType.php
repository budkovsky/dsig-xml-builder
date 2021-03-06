<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Entity;

use Budkovsky\Aid\Abstraction\StaticFactoryInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\KeyInfoChildInterface;
use Budkovsky\DsigXmlBuilder\Collection\TransformTypeCollection;
use Budkovsky\DsigXmlBuilder\Partial\TypeAttributeTrait;
use Budkovsky\DsigXmlBuilder\Partial\UriAttributeTrait;
use Budkovsky\DsigXmlBuilder\Partial\EntityAdapterTrait;
use Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\RetrievalMethodAdapter;

/**
 * RetrievalMethodType entity
 *
 * ```xml
 * <complexType name="RetrievalMethodType">
 *   <sequence>
 *     <element ref="ds:Transforms" minOccurs="0"/>
 *   </sequence>
 *   <attribute name="URI" type="anyURI"/>
 *   <attribute name="Type" type="anyURI" use="optional"/>
 * </complexType>
 * ```
 */
class RetrievalMethodType implements DSigTypeInterface, StaticFactoryInterface, KeyInfoChildInterface
{
    use UriAttributeTrait;
    use TypeAttributeTrait;
    use EntityAdapterTrait;

    /** @var TransformTypeCollection */
    private $transforms;

    /**
     * RetrievalMethodType entity constructor
     */
    public function __construct()
    {
        $this->transforms = new TransformTypeCollection();
    }

    /**
     * RetrievalMethodType entity static factory
     * @return RetrievalMethodType
     */
    public static function create(): RetrievalMethodType
    {
        return new static;
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
     * @return RetrievalMethodType
     */
    public function setTransforms(TransformTypeCollection $transforms): RetrievalMethodType
    {
        $this->transforms = $transforms;

        return $this;
    }

    /**
     * Adds transform to the collection
     *
     * @param TransformType $transform
     * @return RetrievalMethodType
     */
    public function addTransform(TransformType $transform): RetrievalMethodType
    {
        if (!$this->transforms) {
            $this->transforms = new TransformTypeCollection();
        }
        $this->transforms->add($transform);

        return $this;
    }

    /**
     * Returns default adapter for RetrievalMethodType entity
     * @return RetrievalMethodAdapter
     */
    protected function getDefaultAdapter(): AdapterInterface
    {
        return new RetrievalMethodAdapter();
    }
}
