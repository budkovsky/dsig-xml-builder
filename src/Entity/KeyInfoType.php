<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Entity;

use Budkovsky\Aid\Abstraction\StaticFactoryInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Partial\ChildrenTrait;
use Budkovsky\DsigXmlBuilder\Partial\IdAttributeTrait;
use Budkovsky\DsigXmlBuilder\Partial\EntityAdapterTrait;
use Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\KeyInfoAdapter;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;

/**
 * KeyInfoType entity
 *
 * ```xml
 * <complexType name="KeyInfoType" mixed="true">
 *   <choice maxOccurs="unbounded">
 *     <element ref="ds:KeyName"/>
 *     <element ref="ds:KeyValue"/>
 *     <element ref="ds:RetrievalMethod"/>
 *     <element ref="ds:X509Data"/>
 *     <element ref="ds:PGPData"/>
 *     <element ref="ds:SPKIData"/>
 *     <element ref="ds:MgmtData"/>
 *     <any processContents="lax" namespace="##other"/>
 *     <!-- (1,1) elements from (0,unbounded) namespaces -->
 *   </choice>
 *   <attribute name="Id" type="ID" use="optional"/>
 * </complexType>
 * ```
 */
class KeyInfoType implements DSigTypeInterface, StaticFactoryInterface
{
    use IdAttributeTrait;
    use ChildrenTrait;
    use EntityAdapterTrait;

    /**
     * KeyInfoType entity static factory
     * @return KeyInfoType
     */
    public static function create(): KeyInfoType
    {
        return new static;
    }

    protected function getDefaultAdapter(): AdapterInterface
    {
        return new KeyInfoAdapter();
    }
}
