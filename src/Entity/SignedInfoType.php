<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Entity;

use Budkovsky\Aid\Abstraction\StaticFactoryInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Collection\ReferenceTypeCollection;
use Budkovsky\DsigXmlBuilder\Partial\IdAttributeTrait;

/**
 * SignedInfoType entity
 *
 * ```xml
 * <complexType name="SignedInfoType">
 *   <sequence>
 *     <element ref="ds:CanonicalizationMethod"/>
 *     <element ref="ds:SignatureMethod"/>
 *     <element ref="ds:Reference" maxOccurs="unbounded"/>
 *   </sequence>
 *   <attribute name="Id" type="ID" use="optional"/>
 * </complexType>
 * ```
 */
class SignedInfoType implements DSigTypeInterface, StaticFactoryInterface
{
    use IdAttributeTrait;

    /** @var CanonicalizationMethodType */
    private $canonicalizationMethod;

    /** @var SignatureMethodType */
    private $signatureMethod;

    /** @var ReferenceTypeCollection */
    private $references;

    /**
     * SignedInfoType constructor
     */
    public function __construct()
    {
        $this->references = new ReferenceTypeCollection();
    }

    /**
     * SignedInfoType static factory
     * @return SignedInfoType
     */
    public static function create(): SignedInfoType
    {
        return new static;
    }

    /**
     * @return CanonicalizationMethodType|NULL
     */
    public function getCanonicalizationMethod(): ?CanonicalizationMethodType
    {
        return $this->canonicalizationMethod;
    }

    /**
     * @param string $canonicalizationMethod
     * @return SignedInfoType
     */
    public function setCanonicalizationMethod(CanonicalizationMethodType $canonicalizationMethod): SignedInfoType
    {
        $this->canonicalizationMethod = $canonicalizationMethod;

        return $this;
    }

    /**
     * @return SignatureMethodType|NULL
     */
    public function getSignatureMethod(): ?SignatureMethodType
    {
        return $this->signatureMethod;
    }

    /**
     * @param SignatureMethodType $signatureMethod
     * @return SignedInfoType
     */
    public function setSignatureMethod(SignatureMethodType $signatureMethod): SignedInfoType
    {
        $this->signatureMethod = $signatureMethod;

        return $this;
    }

    /**
     * @return ReferenceTypeCollection|NULL
     */
    public function getReferences(): ?ReferenceTypeCollection
    {
        return $this->references;
    }

    /**
     * @param ReferenceTypeCollection $references
     * @return SignedInfoType
     */
    public function setReferences(ReferenceTypeCollection $references): SignedInfoType
    {
        $this->references = $references;

        return $this;
    }

    /**
     * @param ReferenceType $reference
     * @return SignedInfoType
     */
    public function addReference(ReferenceType $reference): SignedInfoType
    {
        $this->references->add($reference);

        return $this;
    }
}
