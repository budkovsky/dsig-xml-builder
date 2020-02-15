<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Entity;

use Budkovsky\Aid\Abstraction\StaticFactoryInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\SimpleContentInterface;
use Budkovsky\DsigXmlBuilder\Exception\RestrictionException;
use Budkovsky\DsigXmlBuilder\Helper\Restriction;
use Budkovsky\DsigXmlBuilder\Partial\ChildrenTrait;
use Budkovsky\DsigXmlBuilder\Partial\EntityAdapterTrait;
use Budkovsky\DsigXmlBuilder\Partial\IdAttributeTrait;
use Budkovsky\DsigXmlBuilder\Partial\SimpleContentTrait;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\ObjectAdapter;

/**
 * ObjectType entity
 *
 * ```xml
 * <complexType name="ObjectType" mixed="true">
 *   <sequence minOccurs="0" maxOccurs="unbounded">
 *     <any namespace="##any" processContents="lax"/>
 *   </sequence>
 *   <attribute name="Id" type="ID" use="optional"/>
 *   <attribute name="MimeType" type="string" use="optional"/> <!-- add a grep facet -->
 *   <attribute name="Encoding" type="anyURI" use="optional"/>
 * </complexType>
 * ```
 */
class ObjectType implements DSigTypeInterface, StaticFactoryInterface, SimpleContentInterface
{
    use IdAttributeTrait;
    use ChildrenTrait;
    use SimpleContentTrait;
    use EntityAdapterTrait;

    /** @var string */
    private $mimeType;

    /** @var string */
    private $encoding;

    /**
     * ObjectType entity static factory
     * @return ObjectType
     */
    public static function create(): ObjectType
    {
        return new static;
    }

    /**
     * Getter of mimeType
     *
     * @return string|NULL
     */
    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }

    /**
     * Setter for mimeType
     *
     * @param string $mimeType
     * @return ObjectType
     */
    public function setMimeType(string $mimeType): ObjectType
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    /**
     * Getter of encoding
     *
     * @return string|NULL
     */
    public function getEncoding(): ?string
    {
        return $this->encoding;
    }

    /**
     * Setter for encoding
     *
     * @param string $encoding
     * @throws RestrictionException
     * @return ObjectType
     */
    public function setEncoding(string $encoding):  ObjectType
    {
        if (!Restriction::isUri($encoding)) {
            throw new RestrictionException("Encoding `$encoding` is not valid URI");
        }

        $this->encoding = $encoding;

        return $this;
    }

    /**
     * Returns default adapter for ObjectType entity
     * @return ObjectAdapter
     */
    protected function getDefaultAdapter(): AdapterInterface
    {
        return new ObjectAdapter();
    }
}
