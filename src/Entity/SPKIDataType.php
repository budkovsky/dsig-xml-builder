<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Entity;

use Budkovsky\Aid\Abstraction\StaticFactoryInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\KeyInfoChildInterface;
use Budkovsky\DsigXmlBuilder\Partial\ChildrenTrait;

/**
 * SPKIDataType entity
 *
 * ```xml
 * <complexType name="SPKIDataType">
 *   <sequence maxOccurs="unbounded">
 *     <element name="SPKISexp" type="base64Binary"/>
 *     <any namespace="##other" processContents="lax" minOccurs="0"/>
 *   </sequence>
 * </complexType>
 * ```
 */
class SPKIDataType implements DSigTypeInterface, StaticFactoryInterface, KeyInfoChildInterface
{
    use ChildrenTrait;

    /**
     * SPKIDataType entity static factory
     */
    public static function create(): SPKIDataType
    {
        return new static;
    }
}
