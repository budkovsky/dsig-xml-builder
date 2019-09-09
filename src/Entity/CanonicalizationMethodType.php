<?php
namespace Budkovsky\DsigXmlBuilder\Entity;

use Budkovsky\Aid\Abstraction\StaticFactoryInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Partial\AlgorithmAttributeTrait;
use Budkovsky\DsigXmlBuilder\Partial\ChildrenTrait;

/**
 * CanoncalizationMethodType entity
 *
 * ```xml
 * <complexType name="CanonicalizationMethodType" mixed="true">
 *   <sequence>
 *     <any namespace="##any" minOccurs="0" maxOccurs="unbounded"/>
 *     <!-- (0,unbounded) elements from (1,1) namespace -->
 *   </sequence>
 *   <attribute name="Algorithm" type="anyURI" use="required"/>
 * </complexType>
 * ```
 */
class CanonicalizationMethodType implements DSigTypeInterface, StaticFactoryInterface
{
    use AlgorithmAttributeTrait;
    use ChildrenTrait;

    /**
     * CanonicalizationMethodType entity static factory
     * @return CanonicalizationMethodType
     */
    public static function create(): CanonicalizationMethodType
    {
        return new static;
    }
}
