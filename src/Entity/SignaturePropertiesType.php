<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Entity;

use Budkovsky\Aid\Abstraction\StaticFactoryInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\AdapterInterface;
use Budkovsky\DsigXmlBuilder\Abstraction\DSigTypeInterface;
use Budkovsky\DsigXmlBuilder\Collection\SignaturePropertyCollection;
use Budkovsky\DsigXmlBuilder\Partial\IdAttributeTrait;
use Budkovsky\DsigXmlBuilder\Partial\EntityAdapterTrait;
use Budkovsky\DsigXmlBuilder\Adapter\DOMDocument\SignaturePropertiesAdapter;

/**
 * SignaturePropertiesType entity
 *
 * ```xml
 * <complexType name="SignaturePropertiesType">
 *   <sequence>
 *     <element ref="ds:SignatureProperty" maxOccurs="unbounded"/>
 *   </sequence>
 *   <attribute name="Id" type="ID" use="optional"/>
 * </complexType>
 * ```
 */
class SignaturePropertiesType implements DSigTypeInterface, StaticFactoryInterface
{
    use IdAttributeTrait;
    use EntityAdapterTrait;

    private $signatureProperties;

    /**
     * SignaturePropertiesType entity constructor
     */
    public function __construct()
    {
        $this->signatureProperties = new SignaturePropertyCollection();
    }

    /**
     * SignaturePropertiesType entity static factory
     * @return SignaturePropertiesType
     */
    public static function create(): SignaturePropertiesType
    {
        return new static;
    }

    /**
     * Getter of signature properties
     *
     * @return SignaturePropertyCollection|NULL
     */
    public function getSignatureProperties(): ?SignaturePropertyCollection
    {
        return $this->signatureProperties;
    }

    /**
     * Setter for signature properties
     *
     * @param SignaturePropertyCollection $signatureProperties
     * @return SignaturePropertiesType
     */
    public function setSignatureProperties(
        SignaturePropertyCollection $signatureProperties
    ): SignaturePropertiesType {
        $this->signatureProperties = $signatureProperties;

        return $this;
    }

    /**
     * Adds signature property to the collection
     *
     * @param SignaturePropertyType $signatureProperty
     * @return SignaturePropertiesType
     */
    public function addSignatureProperty(
        SignaturePropertyType $signatureProperty
    ): SignaturePropertiesType {
        $this->signatureProperties->add($signatureProperty);

        return $this;
    }

    /**
     * Returns default adapter for SignaturePropertiesType entity
     * @return SignaturePropertiesAdapter
     */
    protected function getDefaultAdapter(): AdapterInterface
    {
        return new SignaturePropertiesAdapter();
    }
}
