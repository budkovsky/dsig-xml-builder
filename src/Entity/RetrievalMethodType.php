<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Entity;

use Budkovsky\Aid\Abstraction\StaticFactoryInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\KeyInfoChildInterface;
use Budkovsky\DsigXmlBuilder\Collection\TransformTypeCollection;
use Budkovsky\DsigXmlBuilder\Partial\TypeAttributeTrait;
use Budkovsky\DsigXmlBuilder\Partial\UriAttributeTrait;

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
     * @return TransformTypeCollection|NULL
     */
    public function getTransforms(): ?TransformTypeCollection
    {
        return $this->transforms;
    }

    /**
     * @param TransformTypeCollection $transforms
     * @return RetrievalMethodType
     */
    public function setTransforms(TransformTypeCollection $transforms): RetrievalMethodType
    {
        $this->transforms = $transforms;

        return $this;
    }

    public function addTransform(TransformType $transform): RetrievalMethodType
    {
        if (!$this->transforms) {
            $this->transforms = new TransformTypeCollection();
        }
        $this->transforms->add($transform);

        return $this;
    }
}

