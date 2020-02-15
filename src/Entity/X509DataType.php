<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Entity;

use Budkovsky\Aid\Abstraction\StaticFactoryInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\KeyInfoChildInterface;
use Budkovsky\DsigXmlBuilder\Partial\ChildrenTrait;
use Budkovsky\DsigXmlBuilder\Partial\EntityAdapterTrait;
use Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\X509DataAdapter;

/**
 * X509DataType entity
 *
 * ```xml
 * <complexType name="X509DataType">
 *   <sequence maxOccurs="unbounded">
 *     <choice>
 *       <element name="X509IssuerSerial" type="ds:X509IssuerSerialType"/>
 *       <element name="X509SKI" type="base64Binary"/>
 *       <element name="X509SubjectName" type="string"/>
 *       <element name="X509Certificate" type="base64Binary"/>
 *       <element name="X509CRL" type="base64Binary"/>
 *       <any namespace="##other" processContents="lax"/>
 *     </choice>
 *   </sequence>
 * </complexType>
 * ```
 */
class X509DataType implements DSigTypeInterface, StaticFactoryInterface, KeyInfoChildInterface
{
    use ChildrenTrait;
    use EntityAdapterTrait;

    /**
     * X509DataType entity static factory
     *
     * @return X509DataType
     */
    public static function create(): X509DataType
    {
        return new static;
    }

    /**
     * Returns default adapter for X509DataType entity
     * @return X509DataAdapter
     */
    protected function getDefaultAdapter(): AdapterInterface
    {
        return new X509DataAdapter();
    }
}
