<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Facade;

use Budkovsky\DsigXmlBuilder\Abstraction\GeneratorAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\RSAGeneratorAbstract;
use Budkovsky\DsigXmlBuilder\Entity\TransformType;

/**
 * Generator for enveloped RSA signature
 */
class RSAEnvelopedSignatureGenerator extends RSAGeneratorAbstract
{
    /** @var \DOMElement */
    protected $signatureElement;

    /** @var string */
    protected $digestValueBase;

    /**
     * Static factory for enveloped RSA signature generator
     *
     * @return RSAEnvelopedSignatureGenerator
     */
    public static function create(): RSAEnvelopedSignatureGenerator
    {
        return new static;
    }

    /**
     * {@inheritDoc}
     */
    protected function processSignedInfo(): GeneratorAbstract
    {
        parent::processSignedInfo();
        $this->contentReferenceEntity
            ->setUriAttribute('')
            ->addTransform(
                TransformType::create()->setAlgorithmAttribute(
                    'http://www.w3.org/2000/09/xmldsig#enveloped-signature'
                )
            )
        ;

        return $this;
    }

    /**
     * Loads body of document will contain signature
     * @param string $xml
     * @return RSAEnvelopedSignatureGenerator
     */
    public function loadDocument(string $xml): RSAEnvelopedSignatureGenerator
    {
        $this->document->loadXML($xml);
        $this->digestValueBase = $this->document->documentElement->C14N();

        return $this;
    }

    /**
     * Setter of DOM node the signature will be inserted before
     *
     * @param \DOMNode $node
     * @return RSAEnvelopedSignatureGenerator
     */
    public function setInsertBeforeElement(\DOMNode $node): RSAEnvelopedSignatureGenerator
    {
        $this->insertBeforeElement = $node;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    protected function getDigestValueBase(): string
    {
        return $this->digestValueBase;
    }

    /**
     * {@inheritDoc}
     */
    protected function processObject(): GeneratorAbstract
    {
        return $this; //<Object> element does not exist in eveloped signature
    }
}
