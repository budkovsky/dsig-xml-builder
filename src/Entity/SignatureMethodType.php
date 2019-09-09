<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Entity;

use Budkovsky\Aid\Abstraction\StaticFactoryInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Partial\AlgorithmAttributeTrait;
use Budkovsky\DsigXmlBuilder\Partial\ChildrenTrait;

/**
 * SignatureMethodType entity
 *
 * ```xml
 * <complexType name="SignatureMethodType" mixed="true">
 *   <sequence>
 *     <element name="HMACOutputLength" minOccurs="0" type="ds:HMACOutputLengthType"/>
 *     <any namespace="##other" minOccurs="0" maxOccurs="unbounded"/>
 *     <!-- (0,unbounded) elements from (1,1) external namespace -->
 *   </sequence>
 *   <attribute name="Algorithm" type="anyURI" use="required"/>
 * </complexType>
 * ```
 */
class SignatureMethodType implements DSigTypeInterface, StaticFactoryInterface
{
    use AlgorithmAttributeTrait;
    use ChildrenTrait;

    /** @var int */
    protected $hmacOutputLength;

    /**
     * SignatureMethodType entity static factory
     */
    public static function create(): SignatureMethodType
    {
        return new static;
    }

    /**
     * @return int|NULL
     */
    public function getHmacOutputLength(): ?int
    {
        return $this->hmacOutputLength;
    }

    /**
     * @param int $hmacOutputLength
     * @return SignatureMethodType
     */
    public function setHmacOutputLength(int $hmacOutputLength): SignatureMethodType
    {
        $this->hmacOutputLength = $hmacOutputLength;

        return $this;
    }
}