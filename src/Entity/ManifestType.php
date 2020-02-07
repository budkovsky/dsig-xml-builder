<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Entity;

use Budkovsky\Aid\Abstraction\StaticFactoryInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Collection\ReferenceTypeCollection;
use Budkovsky\DsigXmlBuilder\Partial\IdAttributeTrait;
use Budkovsky\DsigXmlBuilder\Partial\EntityAdapterTrait;
use Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\ManifestAdapter;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;

/**
 * ManifestType entity
 *
 * ```xml
 * <complexType name="ManifestType">
 *   <sequence>
 *     <element ref="ds:Reference" maxOccurs="unbounded"/>
 *   </sequence>
 *   <attribute name="Id" type="ID" use="optional"/>
 * </complexType>
 * ```
 */
class ManifestType implements DSigTypeInterface, StaticFactoryInterface
{
    use IdAttributeTrait;
    use EntityAdapterTrait;

    /** @var ReferenceTypeCollection */
    private $references;

    /**
     * ManifestType entity static factory
     * @return ManifestType
     */
    public static function create(): ManifestType
    {
        return new static;
    }

    /**
     * @return ReferenceTypeCollection|NULL
     */
    public function getReferences(): ?ReferenceTypeCollection
    {
        return $this->references;
    }

    /**
     * @param ReferenceTypeCollection $references
     * @return ManifestType
     */
    public function setReferences(ReferenceTypeCollection $references): ManifestType
    {
        $this->references = $references;

        return $this;
    }

    /**
     * @param ReferenceType $reference
     * @return ManifestType
     */
    public function addReference(ReferenceType $reference): ManifestType
    {
        if (!$this->references) {
            $this->references = new ReferenceTypeCollection();
        }
        $this->references->add($reference);

        return $this;
    }

    protected function getDefaultAdapter(): AdapterInterface
    {
        return new ManifestAdapter();
    }
}
