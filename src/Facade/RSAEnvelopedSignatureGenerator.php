<?php
declare(strict_types = 1);

namespace Budkovsky\DsigXmlBuilder\Facade;

use Budkovsky\DsigXmlBuilder\Abstraction\GeneratorAbstract;
use Budkovsky\DsigXmlBuilder\Abstraction\RSAGeneratorAbstract;
use Budkovsky\DsigXmlBuilder\Entity\TransformType;

class RSAEnvelopedSignatureGenerator extends RSAGeneratorAbstract
{
    /** @var \DOMElement */
    protected $signatureElement;

    /** @var string */
    protected $digestValueBase;

    public static function create(): RSAEnvelopedSignatureGenerator
    {
        return new static;
    }

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

    public function loadDocument(string $xml): RSAEnvelopedSignatureGenerator
    {
        $this->document->loadXML($xml);
        $this->digestValueBase = $this->document->documentElement->C14N();

        return $this;
    }


    public function setInsertBeforeElement(\DOMNode $node): RSAEnvelopedSignatureGenerator
    {
        $this->insertBeforeElement = $node;

        return $this;
    }

    protected function getDigestValueBase(): string
    {
        return $this->digestValueBase;
    }

    protected function processObject(): GeneratorAbstract
    {
        return $this; //<Object> element does not exist in eveloped signature
    }
}
