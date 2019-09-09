<?php
declare(strict_types = 1);
namespace Budkovsky\DsigXmlBuilder\Entity;

use Budkovsky\Aid\Abstraction\StaticFactoryInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Partial\IdAttributeTrait;
use Budkovsky\DsigXmlBuilder\Partial\SimpleContentTrait;

/**
 * SignatureValueType entity
 *
 * ```xml
 * <complexType name="SignatureValueType">
 *   <simpleContent>
 *     <extension base="base64Binary">
 *       <attribute name="Id" type="ID" use="optional"/>
 *     </extension>
 *   </simpleContent>
 * </complexType>
 * ```
 */
class SignatureValueType implements DSigTypeInterface, StaticFactoryInterface
{
    use IdAttributeTrait;
    use SimpleContentTrait;

    /**
     * SignatureValueType entity static factory
     */
    public static function create(): SignatureValueType
    {
        return new static();
    }
}
