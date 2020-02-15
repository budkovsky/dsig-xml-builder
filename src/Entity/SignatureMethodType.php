<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Entity;

use Budkovsky\Aid\Abstraction\StaticFactoryInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Partial\AlgorithmAttributeTrait;
use Budkovsky\DsigXmlBuilder\Partial\ChildrenTrait;
use Budkovsky\DsigXmlBuilder\Partial\EntityAdapterTrait;
use Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\SignatureMethodAdapter;

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
    use EntityAdapterTrait;

    /** @var int */
    protected $hmacOutputLength;

    /**
     * SignatureMethodType entity static factory
     *
     * @return SignatureMethodType
     */
    public static function create(): SignatureMethodType
    {
        return new static;
    }

    /**
     * Getter of HMAC output length
     *
     * @return int|NULL
     */
    public function getHmacOutputLength(): ?int
    {
        return $this->hmacOutputLength;
    }

    /**
     * Setter for HMAC output length
     *
     * @param int $hmacOutputLength
     * @return SignatureMethodType
     */
    public function setHmacOutputLength(int $hmacOutputLength): SignatureMethodType
    {
        $this->hmacOutputLength = $hmacOutputLength;

        return $this;
    }

    /**
     * Returns default adapter for SignatureMethodType entity
     *
     * @return SignatureMethodAdapter
     */
    protected function getDefaultAdapter(): AdapterInterface
    {
        return new SignatureMethodAdapter();
    }
}
