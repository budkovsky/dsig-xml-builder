<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Entity;

use Budkovsky\Aid\Abstraction\StaticFactoryInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Partial\AlgorithmAttributeTrait;
use Budkovsky\DsigXmlBuilder\Partial\ChildrenTrait;
use Budkovsky\DsigXmlBuilder\Partial\EntityAdapterTrait;
use Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\TransformAdapter;

/**
 * TransformType entity
 *
 * ```xml
 * <complexType name="TransformType" mixed="true">
 *   <choice minOccurs="0" maxOccurs="unbounded">
 *     <any namespace="##other" processContents="lax"/>
 *     <!-- (1,1) elements from (0,unbounded) namespaces -->
 *     <element name="XPath" type="string"/>
 *   </choice>
 *   <attribute name="Algorithm" type="anyURI" use="required"/>
 * </complexType>
 * ```
 */
class TransformType implements DSigTypeInterface, StaticFactoryInterface
{
    use AlgorithmAttributeTrait;
    use ChildrenTrait;
    use EntityAdapterTrait;

    public static function create(): TransformType
    {
        return new static;
    }

    protected function getDefaultAdapter(): AdapterInterface
    {
        return new TransformAdapter();
    }
}
