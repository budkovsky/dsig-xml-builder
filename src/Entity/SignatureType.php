<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Entity;

use Budkovsky\Aid\Abstraction\StaticFactoryInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Collection\ObjectTypeCollection;
use Budkovsky\DsigXmlBuilder\Partial\IdAttributeTrait;
use Budkovsky\DsigXmlBuilder\Collection\KeyInfoTypeCollection;
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

    /** @var KeyInfoTypeCollection */
    private $keyInfoCollection;

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
     * @return SignedInfoType|NULL
     */
    public function getSignedInfo(): ?SignedInfoType
    {
        return $this->signedInfo;
    }

    /**
     * @param SignedInfoType $signedInfo
     * @return SignatureType
     */
    public function setSignedInfo(SignedInfoType $signedInfo): SignatureType
    {
        $this->signedInfo = $signedInfo;

        return $this;
    }

    /**
     * @return SignatureValueType|NULL
     */
    public function getSignatureValue(): ?SignatureValueType
    {
        return $this->signatureValue;
    }

    /**
     * @param SignatureValueType $signatureValue
     * @return SignatureType
     */
    public function setSignatureValue(SignatureValueType $signatureValue): SignatureType
    {
        $this->signatureValue = $signatureValue;

        return $this;
    }

    /**
     * @return KeyInfoTypeCollection|NULL
     */
    public function getKeyInfoCollection(): ?KeyInfoTypeCollection
    {
        return $this->keyInfoCollection;
    }

    /**
     * @param KeyInfoTypeCollection $keyInfo
     * @return SignatureType
     */
    public function setKeyInfoCollection(KeyInfoTypeCollection $keyInfo): SignatureType
    {
        $this->keyInfoCollection = $keyInfo;

        return $this;
    }

    public function addKeyInfo(KeyInfoType $keyInfo): SignatureType
    {
        if (!$this->keyInfoCollection) {
            $this->keyInfoCollection = new KeyInfoTypeCollection();
        }
        $this->keyInfoCollection->add($keyInfo);

        return $this;
    }

    /**
     * @return ObjectTypeCollection|NULL
     */
    public function getObjects(): ?ObjectTypeCollection
    {
        return $this->objects;
    }

    public function setObjects(ObjectTypeCollection $objects): SignatureType
    {
        $this->objects = $objects;

        return $this;
    }

    /**
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

    protected function getDefaultAdapter(): AdapterInterface
    {
        return new SignatureAdapter();
    }

}
