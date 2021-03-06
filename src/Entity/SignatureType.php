<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Entity;

use Budkovsky\Aid\Abstraction\StaticFactoryInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Collection\ObjectTypeCollection;
use Budkovsky\DsigXmlBuilder\Partial\IdAttributeTrait;
use Budkovsky\DsigXmlBuilder\Partial\EntityAdapterTrait;
use Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\SignatureAdapter;

/**
 * SignatureType entity
 *
 * ```xml
 * <complexType name="SignatureType">
 *   <sequence>
 *     <element ref="ds:SignedInfo"/>
 *     <element ref="ds:SignatureValue"/>
 *     <element ref="ds:KeyInfo" minOccurs="0"/>
 *     <element ref="ds:Object" minOccurs="0" maxOccurs="unbounded"/>
 *   </sequence>
 *   <attribute name="Id" type="ID" use="optional"/>
 * </complexType>
 * ```
 */
class SignatureType implements DSigTypeInterface, StaticFactoryInterface
{
    use IdAttributeTrait;
    use EntityAdapterTrait;

    /** @var SignedInfoType */
    private $signedInfo;

    /** @var SignatureValueType */
    private $signatureValue;

    /** @var KeyInfoType */
    private $keyInfo;

    /** @var ObjectTypeCollection */
    private $objects;

    /**
     * SignatureType entity static factory
     * @return SignatureType
     */
    public static function create(): SignatureType
    {
        return new static();
    }

    /**
     * Getter of SignedInfo
     *
     * @return SignedInfoType|NULL
     */
    public function getSignedInfo(): ?SignedInfoType
    {
        return $this->signedInfo;
    }

    /**
     * Setter for SignedInfo
     *
     * @param SignedInfoType $signedInfo
     * @return SignatureType
     */
    public function setSignedInfo(SignedInfoType $signedInfo): SignatureType
    {
        $this->signedInfo = $signedInfo;

        return $this;
    }

    /**
     * Getter of SignatureValue
     *
     * @return SignatureValueType|NULL
     */
    public function getSignatureValue(): ?SignatureValueType
    {
        return $this->signatureValue;
    }

    /**
     * Setter for SignatureValue
     *
     * @param SignatureValueType $signatureValue
     * @return SignatureType
     */
    public function setSignatureValue(SignatureValueType $signatureValue): SignatureType
    {
        $this->signatureValue = $signatureValue;

        return $this;
    }

    /**
     * Getter of KeyInfo
     *
     * @return KeyInfoType|NULL
     */
    public function getKeyInfo(): ?KeyInfoType
    {
        return $this->keyInfo;
    }

    /**
     * Setter for KeyInfo
     *
     * @param KeyInfoType $keyInfo
     * @return SignatureType
     */
    public function setKeyInfo(KeyInfoType $keyInfo): SignatureType
    {
        $this->keyInfo = $keyInfo;

        return $this;
    }

    /**
     * Getter of object collection
     *
     * @return ObjectTypeCollection|NULL
     */
    public function getObjects(): ?ObjectTypeCollection
    {
        return $this->objects;
    }

    /**
     * Setter for object collection
     *
     * @param ObjectTypeCollection $objects
     * @return SignatureType
     */
    public function setObjects(ObjectTypeCollection $objects): SignatureType
    {
        $this->objects = $objects;

        return $this;
    }

    /**
     * Adds object to the collection
     *
     * @param ObjectType $object
     * @return SignatureType
     */
    public function addObject(ObjectType $object): SignatureType
    {
        if (!$this->objects) {
            $this->objects = new ObjectTypeCollection();
        }
        $this->objects->add($object);

        return $this;
    }

    /**
     * Returns default adapter for SignatureType entity
     *
     * @return SignatureAdapter
     */
    protected function getDefaultAdapter(): AdapterInterface
    {
        return new SignatureAdapter();
    }
}
