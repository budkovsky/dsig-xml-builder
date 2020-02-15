<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Entity;

use Budkovsky\Aid\Abstraction\StaticFactoryInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Collection\ReferenceTypeCollection;
use Budkovsky\DsigXmlBuilder\Partial\IdAttributeTrait;
use Budkovsky\DsigXmlBuilder\Partial\EntityAdapterTrait;
use Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\SignedInfoAdapter;

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
    use EntityAdapterTrait;

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
     * SignedInfoType entity static factory
     * @return SignedInfoType
     */
    public static function create(): SignedInfoType
    {
        return new static;
    }

    /**
     * Getter of canonicalization method
     *
     * @return CanonicalizationMethodType|NULL
     */
    public function getCanonicalizationMethod(): ?CanonicalizationMethodType
    {
        return $this->canonicalizationMethod;
    }

    /**
     * Setter for canonicalization method
     *
     * @param string $canonicalizationMethod
     * @return SignedInfoType
     */
    public function setCanonicalizationMethod(CanonicalizationMethodType $canonicalizationMethod): SignedInfoType
    {
        $this->canonicalizationMethod = $canonicalizationMethod;

        return $this;
    }

    /**
     * Getter of signature method
     *
     * @return SignatureMethodType|NULL
     */
    public function getSignatureMethod(): ?SignatureMethodType
    {
        return $this->signatureMethod;
    }

    /**
     * Setter for signature method
     *
     * @param SignatureMethodType $signatureMethod
     * @return SignedInfoType
     */
    public function setSignatureMethod(SignatureMethodType $signatureMethod): SignedInfoType
    {
        $this->signatureMethod = $signatureMethod;

        return $this;
    }

    /**
     * Getter of reference collection
     *
     * @return ReferenceTypeCollection|NULL
     */
    public function getReferences(): ?ReferenceTypeCollection
    {
        return $this->references;
    }

    /**
     * Setter for reference collection
     *
     * @param ReferenceTypeCollection $references
     * @return SignedInfoType
     */
    public function setReferences(ReferenceTypeCollection $references): SignedInfoType
    {
        $this->references = $references;

        return $this;
    }

    /**
     * Adds reference to the collection
     *
     * @param ReferenceType $reference
     * @return SignedInfoType
     */
    public function addReference(ReferenceType $reference): SignedInfoType
    {
        $this->references->add($reference);

        return $this;
    }

    /**
     * Returns default adapter for SignedInfoType entity
     * @return SignedInfoAdapter
     */
    protected function getDefaultAdapter(): AdapterInterface
    {
        return new SignedInfoAdapter();
    }
}
