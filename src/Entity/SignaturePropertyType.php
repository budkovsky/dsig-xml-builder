<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Entity;

use Budkovsky\Aid\Abstraction\StaticFactoryInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Partial\ChildrenTrait;
use Budkovsky\DsigXmlBuilder\Partial\IdAttributeTrait;
use Budkovsky\DsigXmlBuilder\Partial\EntityAdapterTrait;
use Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\SignaturePropertyAdapter;

/**
 * SignaturePropertyType entity
 *
 * ```xml
 * <complexType name="SignaturePropertyType" mixed="true">
 *   <choice maxOccurs="unbounded">
 *     <any namespace="##other" processContents="lax"/>
 *     <!-- (1,1) elements from (1,unbounded) namespaces -->
 *   </choice>
 *   <attribute name="Target" type="anyURI" use="required"/>
 *   <attribute name="Id" type="ID" use="optional"/>
 * </complexType>
 * ```
 */
class SignaturePropertyType implements DSigTypeInterface, StaticFactoryInterface
{
    use ChildrenTrait;
    use IdAttributeTrait;
    use EntityAdapterTrait;

    /** @var string */
    private $targetAttribute;

    /**
     * SignaturePropertyType entity static factory
     * @return SignaturePropertyType
     */
    public static function create()
    {
        return new static;
    }

    /**
     * @return string|NULL
     */
    public function getTargetAttribute(): ?string
    {
        return $this->targetAttribute;
    }

    /**
     * @param string $targetAttribute
     * @return SignaturePropertyType
     */
    public function setTargetAttribute(string $targetAttribute): SignaturePropertyType
    {
        $this->targetAttribute = $targetAttribute;

        return $this;
    }

    protected function getDefaultAdapter(): AdapterInterface
    {
        return new SignaturePropertyAdapter();
    }

}
