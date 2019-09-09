<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Entity;

use Budkovsky\Aid\Abstraction\StaticFactoryInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Partial\AlgorithmAttributeTrait;
use Budkovsky\DsigXmlBuilder\Partial\ChildrenTrait;

/**
 * DigestMethodType entity
 *
 * ```xml
 * <complexType name="DigestMethodType" mixed="true">
 *   <sequence>
 *     <any namespace="##other" processContents="lax" minOccurs="0" maxOccurs="unbounded"/>
 *   </sequence>
 *   <attribute name="Algorithm" type="anyURI" use="required"/>
 * </complexType>
 * ```
 */
class DigestMethodType implements DSigTypeInterface, StaticFactoryInterface
{
    use AlgorithmAttributeTrait;
    use ChildrenTrait;

    /**
     * DigestMethodType entity static factory
     * @return DigestMethodType
     */
    public static function create(): DigestMethodType
    {
        return new static;
    }
}
